@php
    App::setLocale(Cookie::get('local_language'));
@endphp
@extends('layouts.admin')

@section('content')


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>401 没有访问权限</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">首页</a></li>
                        <li class="breadcrumb-item active">401 没有访问权限</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>


    <div class="Hui-article">

        <div class="lockscreen-logo">
            <h1><i class="fa fa-optin-monster"></i></h1>
            <a href="">

                <p class="error-description">{{$code}} - {{$mes}}~</p>
            </a>
        </div>

    </div>
@endsection

