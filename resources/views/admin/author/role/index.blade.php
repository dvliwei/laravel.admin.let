@php
    App::setLocale(Cookie::get('local_language'));
@endphp
@extends('layouts.admin')

@section('content')
    @if (!empty(session('status')) && session('status')==1)
        <div class=" alert alert-success alert-dismissible Huialert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session('msg')}}
        </div>
    @elseif(!empty(session('status')) && session('status')!=1)
        <div class="Huialert alert alert-danger alert-dismissible Huialert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session('msg')}}
        </div>
    @endif


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>角色管理</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">首页</a></li>
                        <li class="breadcrumb-item active">角色管理</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>


    <div class="Hui-article">
        <!--角色view -->
        <div class="modal fade" id="modal-role">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">角色编辑</h3>
                        <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void(0);">×</a>
                    </div>
                    <form action="/admin/author/role/save_role" method="post" role="form"  id="game-form">
                        <input type="hidden" name="id" id="role_id" value="">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName">角色名称：</label>
                                <input type="text" class="form-control" name="role_name" id="role_name" autocomplete="off" required placeholder="角色名称" value="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName">角色说明：</label>
                                <textarea name="comment" id="role_comment"  rows="3" class="form-control" placeholder="Enter ..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary radius" type="submit" >确定</button>
                            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/角色view -->

        <!--权限树 -->
        <div id="modal-tree-role" class="modal fade mt-40" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content radius">
                    <div class="modal-header">
                        <h3 class="modal-title">模块权限分配</h3>
                        <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void(0);">×</a>
                    </div>
                    <input type="hidden" name="per_role_id" id="per_role_id" value="">
                    <div class="modal-body">
                        <div class="zTreeDemoBackground left">
                            <ul id="menu-tree" class="ztree"></ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" onclick="saveRoleMenu()">确定</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                    </div>
                </div>
            </div>
        </div>
        <!--/权限树 -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" onclick="ShowRole()" class="btn  btn-success"><i class="Hui-iconfont">&#xe62b;</i>添加角色</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered text-nowrap text-center">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">id</th>
                                        <th >角色名称</th>
                                        <th>角色介绍</th>
                                        <th style="width: 40px;">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($datas as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->role_name}}</td>
                                            <td>{{$data->comment}}</td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="EditeRole({{$data->id}})" class="btn  btn-success btn-sm w-40">角色编辑</a>
                                                <a href="javascript:void(0);" onclick="set_Permission({{ $data->id }})" class="btn  bg-gradient-info btn-sm w-40">权限设置</a>
                                                <a href="/admin/author/role/del/{{$data->id}}" onclick="if(confirm('确认要删除该角色吗？如何删除该角色，则角色下的用户一并会被删除!!!')==false)return false;" class="btn bg-gradient-danger btn-sm w-40">删除角色</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $datas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


    </div>
@endsection


@section('after-scripts')
    <script type="text/javascript" src="{{ asset('ztree/js/jquery.ztree.core.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ztree/js/jquery.ztree.excheck.js') }}"></script>

    <script>
        var setting = {
            check: {
                enable: true
            },
            view: {
                dblClickExpand: false,
                showLine: false,
                selectedMulti: false
            },
            data: {
                simpleData: {
                    enable: true,
                    idKey: "id",
                    pIdKey: "pId",
                    rootPId: ""
                }
            },
            callback: {
                onCheck: onCheck
            }
        };
        function collapseAll(zTreeId){
            var treeId = zTreeId;
            var zTree = $.fn.zTree.getZTreeObj(treeId);
            zTree.expandAll(false);
        }
        function onCheck(e, treeId, treeNode) {
            var zTree = $.fn.zTree.getZTreeObj("menu-tree"),
                nodes=zTree.getCheckedNodes(true),
                v="";
            for(var i=0;i<nodes.length;i++){
                v+=nodes[i].name + ",";
                //console.log(nodes[i].id); //获取选中节点的值
            }
            console.log("xxxxx");
            //zTree.expandNode(nodes);
        }
        function expandAll(nodes) {
            var zTree = $.fn.zTree.getZTreeObj("menu-tree");
            zTree.expandAll(false);
            for(var i =0; i<nodes.length; i++){

                if(nodes[i].open==true){
                    //使用id作为完全匹配
                    var node=zTree.getNodeByParam('id',nodes[i].id);
                    zTree.expandNode(node, true, false, true);
                }
            }

        }

        var user_id;
        function set_Permission(role_id) {
            $('#per_role_id').val(role_id);
            var get_nodes = "/admin/author/role/prmission/" + role_id;
            $.get(get_nodes, {}, function(data) {
                var zNodes = data;
                console.log(zNodes);
                $.fn.zTree.init($("#menu-tree"), setting, zNodes);
                expandAll(data);
                $('#modal-tree-role').modal('show');
                //collapseAll('menu-tree');
            }, 'JSON');

        }
        function saveRoleMenu(){
            var role_id = $('#per_role_id').val();
            var zTree = $.fn.zTree.getZTreeObj("menu-tree");
            nodes = zTree.getCheckedNodes(true);
            var node_ids;
            for (var i = 0; i < nodes.length; i++) {
                node_ids += nodes[i].id + ','; //获取选中节点的值
            }
            node_ids = node_ids.replace('undefined', '');
            var post_save_adminmenu = "/admin/author/role/add_role_prmission";
            $.post(post_save_adminmenu, {
                role_id: role_id,
                node_ids: node_ids,
                _token:"{{csrf_token()}}"
            }, function(data) {
                if (data.status == 'success') {
                    $('#modal-tree-role').modal('hide');
                    $("#notic").text(data.message);
                    $("#notic").removeClass("hidden");
                    history.go(0);//刷新当前页面
                }
            }, 'JSON');
        }
        var role_id;
        function showModel(role_id){
            $("#modal-tree-role").modal("show")
        }
    </script>




    <script>
        $('#modal-role').on('hidden.bs.modal', function () {
            $("#modal-role input").val("");
            $("#modal-role textarea").text('');
            $("#modal-role textarea").val("");
        });
        var ShowRole = function () {
            $("#modal-role").modal("show");
        }
        var id;
        var EditeRole =function(id){
            var getUrl = "/admin/author/role/edite/"+id;
            $.get(getUrl, {},function(data,status){
                $("#modal-role #role_id").val(data.id);
                $("#modal-role #role_name").val(data.role_name);
                $("#modal-role #role_comment").val(data.comment);
                ShowRole();
            },'JSON');
        }
    </script>
@stop
