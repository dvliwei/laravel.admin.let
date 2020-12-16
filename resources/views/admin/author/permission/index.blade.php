@php
    App::setLocale(Cookie::get('local_language'));
@endphp
@extends('layouts.admin')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>权限列表</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">首页</a></li>
                        <li class="breadcrumb-item active">权限列表</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>


    <div class="Hui-article">
        <!--权限view -->
        <div id="modal-permission" class="modal fade" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">权限信息编辑</h3>
                        <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void(0);">×</a>
                    </div>
                    <form action="/admin/author/permission/save_permission" method="post" role="form" class="form form-horizontal" id="game-form">
                        <input type="hidden" name="permission_id" id="permission_id" value="">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName">权限名称：</label>
                                <input type="text" class="form-control" name="permission_name" id="permission_name" autocomplete="off" required placeholder="角色名称" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">权限说明：</label>
                                <textarea name="permission_comment" id="permission_comment" rows="3" class="form-control"></textarea>
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
        <!--/权限view -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered text-nowrap">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">id</th>
                                        <th >权限名称</th>
                                        <th >权限code</th>
                                        <th >权限说明</th>
                                        <th class=" text-center">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-left">
                                    @foreach($datas as $data)
                                        <tr  class="bg-success disabled color-palette">
                                            <td>{{$data["id"]}}</td>
                                            <td>{{$data["name"]}}</td>
                                            <td>{{$data["route_name"]}}</td>
                                            <td>{{$data["comment"]}}</td>
                                            <td class=" text-center"><a href="javascript:void(0);"  class="btn  btn-default w-40" onclick="EditePermission({{$data["id"]}})">编辑</a> </td>
                                        </tr>
                                        @if(!empty($data["child"]))
                                            @foreach($data["child"] as $child)
                                                <tr class="bg-info disabled color-palette">
                                                    <td  style="text-indent:2em;">{{$child["id"]}}</td>
                                                    <td  style="text-indent:2em;">{{$child["name"]}}</td>
                                                    <td  style="text-indent:2em;">{{$child["route_name"]}}</td>
                                                    <td  style="text-indent:2em;">{{$child["comment"]}}</td>
                                                    <td  class=" text-center"><a href="javascript:void(0);" class="btn  btn-default w-40" onclick="EditePermission({{$child["id"]}})">编辑</a> </td>
                                                </tr>
                                                @if(!empty($child["child"]))
                                                    @foreach($child["child"] as $child1)
                                                        <tr class="bg-primary disabled color-palette">
                                                            <td style="text-indent:4em;">{{$child1["id"]}}</td>
                                                            <td style="text-indent:4em;">{{$child1["name"]}}</td>
                                                            <td style="text-indent:4em;">{{$child1["route_name"]}}</td>
                                                            <td style="text-indent:4em;">{{$child1["comment"]}}</td>
                                                            <td class=" text-center"><a href="javascript:void(0);" class="btn  btn-default w-40" onclick="EditePermission({{$child1["id"]}})">编辑</a> </td>
                                                        </tr>
                                                        @if(!empty($child1["child"]))
                                                            @foreach($child1["child"] as $child2)
                                                                <tr class="bg-danger disabled color-palette">
                                                                    <td style="text-indent:6em;">{{$child2["id"]}}</td>
                                                                    <td style="text-indent:6em;">{{$child2["name"]}}</td>
                                                                    <td style="text-indent:6em;">{{$child2["route_name"]}}</td>
                                                                    <td style="text-indent:6em;">{{$child2["comment"]}}</td>
                                                                    <td class=" text-center"><a href="javascript:void(0);" class="btn  btn-default w-40" onclick="EditePermission({{$child2["id"]}})">编辑</a> </td>
                                                                </tr>
                                                                @if(!empty($child2["child"]))
                                                                    @foreach($child2["child"] as $child3)
                                                                        <tr class="bg-light disabled color-palette">
                                                                            <td style="text-indent:8em;">{{$child3["id"]}}</td>
                                                                            <td style="text-indent:8em;">{{$child3["name"]}}</td>
                                                                            <td style="text-indent:8em;">{{$child3["route_name"]}}</td>
                                                                            <td style="text-indent:8em;">{{$child3["comment"]}}</td>
                                                                            <td class=" text-center"><a href="javascript:void(0);"  class="btn  btn-default w-40" onclick="EditePermission({{$child3["id"]}})">编辑</a> </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

    </div>
@endsection


@section('after-scripts')
    <script>
        $('#modal-permission').on('hidden.bs.modal', function () {
            $("#modal-permission input").val("");
            $("#modal-permission textarea").text("");
            $("#modal-permission textarea").val("");
        });
        var ShowPermission = function () {
            $("#modal-permission").modal("show");
        }
        var id;
        var EditePermission =function(id){
            var getUrl = "/admin/author/permission/edite/"+id;
            $.get(getUrl, {},function(data,status){
                $("#modal-permission #permission_id").val(data.id);
                $("#modal-permission #permission_name").val(data.name);
                $("#modal-permission #permission_comment").val(data.comment);
                ShowPermission();
            },'JSON');
        }
    </script>
@stop
