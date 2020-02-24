<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('adminle/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('adminle/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminle/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link href="{{asset('Hui-iconfont/1.0.8/iconfont.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('ztree/zTreeStyle/zTreeStyle.css') }}" />

</head>
<body class="sidebar-mini text-sm">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light navbar-dark navbar-gray">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <span class="nav-link"   data-slide="true">
                   系统时间:&nbsp;&nbsp;<span id="time-zone">{{getDateByTimeZone(time())}}</span>
                </span>

            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                   {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="/log-viewer" class="dropdown-item">日志</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        退出登录
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                            class="fas fa-th-large"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/home" class="brand-link">
            <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">Home</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v1</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index2.html" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v2</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v3</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @if((int)Auth::user()->id===1)
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview {{ active_class(Active::checkUriPattern('admin/author*'), 'menu-open') }}">
                            <a href="#" class="nav-link">
                                <i class="Hui-iconfont">&#xe611;</i>
                                <p>
                                    权限管理
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/author/permission" class="nav-link {{ active_class(Active::checkUriPattern('admin/author/permission'), 'active') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>权限列表</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/author/role" class="nav-link  {{ active_class(Active::checkUriPattern('admin/author/role'), 'active') }} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>角色管理</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/author/user" class="nav-link  {{ active_class(Active::checkUriPattern('admin/author/user'), 'active') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>人员管理</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview {{ active_class(Active::checkUriPattern('admin/log-viewe*'), 'menu-open') }}">
                            <a href="#" class="nav-link">
                                <i class="Hui-iconfont">&#xe623;</i>
                                <p>
                                    管理员操作日志
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/log-viewer" class="nav-link {{ active_class(Active::checkUriPattern('log-viewer'), 'active') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>系统日志</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endif



            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
</div>
<!-- ./wrapper -->


@yield('before-scripts')
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('adminle/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('adminle/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('adminle/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminle/dist/js/adminlte.js')}}"></script>

<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('adminle/dist/js/demo.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('adminle/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('adminle/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('adminle/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('adminle/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/os/dateTime.js') }}"></script>
<!--/_footer /作为公共模版分离出去-->
<script>
    $(function(){
        localHostDateTime();
        hiddenHuiAlert();
    });
</script>

<!--请在下方写此页面业务相关的脚本-->
@yield('after-scripts')
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>
