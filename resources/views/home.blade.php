@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>服务器运行状态</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">首页</a></li>
                        <li class="breadcrumb-item active">服务器状态</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">监控参数</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>监控条目</th>
                                    <th>参数</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>php版本</td>
                                    <td>{{ PHP_VERSION}}</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>操作系统</td>
                                    <td>{{ PHP_OS}}</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>ZEND版本</td>
                                    <td>{{ zend_version()}}</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>服务器端信息</td>
                                    <td>{{$_SERVER ['SERVER_SOFTWARE']}}</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>服务器端时间</td>
                                    <td>{{date('Y-m-d H:i:s')}}</td>
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td>系统时区使用</td>
                                    <td>{{env('ORDER_TIME_ZONE') }}  ({{env('ORDER_TIME_ZONE_COUNTRY')}})</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
