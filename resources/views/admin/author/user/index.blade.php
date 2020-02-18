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
                    <h1>人员管理</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">首页</a></li>
                        <li class="breadcrumb-item active">人员管理</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <div class="Hui-article">
        <!--角色view -->
         <div class="modal fade" id="modal-user">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">人员编辑</h3>
                        <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void(0);">×</a>
                    </div>
                    <form action="/admin/author/user/save_user" method="post"  role="form" id="user-form">
                        <input type="hidden" name="id" id="user_id" value="">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputName">名称：</label>
                                <input type="text" class="form-control" name="name" id="name" autocomplete="off" required placeholder="昵称" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">用户邮箱：</label>
                                <input type="email" class="form-control" name="email" id="email" autocomplete="off" required placeholder="用户邮箱" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">设置密码：</label>
                                <input type="password" class="form-control" name="password" id="password" autocomplete="off" required placeholder="密码" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">确认密码：</label>
                                <input type="password" class="form-control" name="password1" id="password1" autocomplete="off" required placeholder="确认密码" value="">
                            </div>
                            <div class="form-group">
                                <label>请选择角色</label>
                                <select class="form-control" name="role_id" id="role_id" required>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}"  >{{$role->role_name}}</option>
                                    @endforeach
                                </select>
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

        <!--编辑view -->
        <div id="modal-editer-user"  class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">编辑用户</h3>
                        <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void(0);">×</a>
                    </div>
                    <form action="/admin/author/user/save_user" method="post"  role="form"  id="editer-user-form">
                        <input type="hidden" name="id" id="user_id" value="">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName">名称：</label>
                                <input type="text" class="form-control" name="name" id="name" autocomplete="off" required placeholder="昵称" value="">
                            </div>
                            <div class="form-group">
                                <label>请选择角色</label>
                                <select class="form-control" name="role_id" id="role_id" required>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}"  >{{$role->role_name}}</option>
                                    @endforeach
                                </select>
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
        <!--/辑view -->

        <!--密码view -->
        <div id="modal-user-password" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">修改密码</h3>
                        <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void(0);">×</a>
                    </div>
                    <form action="/admin/author/user/edite_password" method="post" role="form"  id="user-password">
                        <input type="hidden" name="id" id="user_id" value="">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName">新密码：</label>
                                <input type="password" class="form-control" name="tu_password" id="tu_password" autocomplete="off" required placeholder="密码" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">确认密码：</label>
                                <input type="password" class="form-control" name="tu_password1" id="tu_password1" autocomplete="off" required placeholder="确认密码" value="">
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
        <!--/密码view -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0);" onclick="ShowUser()" class="btn  btn-success"><i class="Hui-iconfont">&#xe62b;</i>添加用户</a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered text-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 10px">id</th>
                                    <th>用户名称</th>
                                    <th>账户</th>
                                    <th>角色</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->email}}</td>
                                        <td>
                                            @if($data->role_id==0 && Auth::user()->id==1)
                                                超级管理员
                                            @else
                                                {{$data->userRole->role_name}}
                                            @endif
                                        </td>
                                        <td>

                                            @if($data->role_id==0 && Auth::user()->id==1)
                                                <i class="Hui-iconfont">&#xe631;</i>
                                            @else
                                                <a href="javascript:void(0);" onclick="EditeUser({{$data->id}})" class="btn  btn-success btn-sm w-20">编辑</a>
                                                <a href="javascript:void(0);" onclick="EditeUserPassword({{$data->id}})" class="btn  bg-gradient-info btn-sm w-40">修改密码</a>
                                                <a href="/admin/author/user/del/{{$data->id}}" onclick="if(confirm('确认要删除该用户吗？')==false)return false;" class="btn bg-gradient-danger btn-sm w-40">删除用户</a>
                                            @endif
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

@endsection


@section('after-scripts')
<script type="text/javascript" src="{{  asset('adminle/lib/jquery.validation/1.14.0/jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{  asset('adminle/lib/jquery.validation/1.14.0/validate-methods.js') }}"></script>
<script type="text/javascript" src="{{  asset('adminle/lib/jquery.validation/1.14.0/messages_zh.js') }}"></script>
<script>

    jQuery.validator.addMethod("checkInput", function(value, element) {
        var reg=/ /g;
        var value = value.replace(reg,'');
        if(value.length<4){
            return false;
        }
        var pattern = new RegExp("[.`~!@#$^&*=|{}':;',\\[\\]<>《》/?~！@#￥……&*|{}【】‘；：”“'。，、？'']");
        if(pattern.test(value)) {
            return false;
        } else if(value.indexOf(" ") != -1){
            return false;
        } else {
            return true;
        }
    }, "禁止输入特殊字符及空格");

    $('#user-form').validate({
        rules: {
            name: {
                required: true,
                minlength: 4,
                checkInput: true
            },
            email:{
                required: true,
                email:true,
                remote:"/admin/author/user/emailCheck",
            },
            password:{
                required: true,
                minlength:6
            },
            password1:{
                required: true,
                equalTo: "#password"
            },
            role_id:{
                required:true,
                min: 1
            }


        },
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        messages: {
            name :{
                checkInput: "请输入最少4非空字符"
            },
            email:{
                remote: '邮箱已经存在'
            },
            password1:{
                remote:'密码不一致'
            },
            role_id:{
                remote:'请选择角色'
            }
        },
        submitHandler:function(form){
            form.submit();
        }
    });

    $('#modal-user').on('hidden.bs.modal', function () {
        $("#modal-user input").val("");
        $("#modal-user textarea").text("");
        $("#modal-user textarea").val("");
        $("#modal-user select").val("");
    });
    var ShowUser = function () {
        $("#modal-user").modal("show");
    }
    var id;
    var EditeUser =function(id){
        var getUrl = "/admin/author/user/edite/"+id;
        $.get(getUrl, {},function(data,status){
            $("#modal-editer-user #user_id").val(data.id);
            $("#modal-editer-user #name").val(data.name);
            $("#modal-editer-user #role_id").val(data.role_id);
            $("#modal-editer-user").modal("show");
        },'JSON');
    }


    $('#user-password').validate({
        rules: {
            tu_password:{
                required: true,
                minlength:6
            },
            tu_password1:{
                required: true,
                equalTo: "#tu_password"
            },
        },
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        messages: {
            password1:{
                remote:'密码不一致'
            },
        },
        submitHandler:function(form){
            form.submit();
        }
    });
    var EditeUserPassword = function(id){
        var getUrl = "/admin/author/user/edite/"+id;
        $.get(getUrl, {},function(data,status){
            $("#modal-user-password #user_id").val(data.id);
            $("#modal-user-password").modal("show");
        },'JSON');
    }
</script>
@stop
