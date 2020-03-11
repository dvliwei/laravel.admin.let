<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 3 | Lockscreen</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('adminle/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{asset('adminle/ionicons.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('adminle/dist/css/adminlte.min.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('adminle/ico/css/font-awesome.min.css')}}">
        <style>
            footer{  padding:26% 0 30px 0; width:100%}

        </style>
    </head>
    <body class="hold-transition lockscreen">
        <div class="flex-center position-ref full-height">

            <div class="lockscreen-wrapper">
                <div class="lockscreen-logo">
                    <h1><i class="fa fa-optin-monster"></i></h1>
                    <a href=""><b>Admin</b>LTE</a>
                </div>

                <div class="text-center">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a href="{{ url('/home') }}">Home</a>
                            @else
                                <a href="{{ route('login') }}">Login</a>

                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <footer class="lockscreen-footer text-center">
            Copyright &copy; 2014-2019 <b><a href="https://www.jianshu.com/u/ca4dea526a4d" class="text-black">php.we.li@gmail.com</a></b><br>
            All rights reserved
        </footer>


        <!-- jQuery -->
        <script src="{{asset('adminle/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('adminle/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    </body>
</html>
