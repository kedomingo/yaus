@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    @include('components.linechart', ['title' => 'Daily Visits', 'url' => '/admin/api/v1/visits?group=day', 'group' => 'date'])
                </div>
                <div class="col-lg-4 col-md-6">
                    @include('components.donut', ['title' => 'By browser', 'url' => '/admin/api/v1/visits?group=browser', 'group' => 'browser'])
                </div>
                <div class="col-lg-4 col-md-6">
                    @include('components.donut', ['title' => 'By country', 'url' => '/admin/api/v1/visits?group=country', 'group' => 'country'])
                </div>
                <div class="col-lg-4 col-md-6">
                    @include('components.donut', ['title' => 'By OS', 'url' => '/admin/api/v1/visits?group=os', 'group' => 'platform'])
                </div>
                <div class="col-lg-4 col-md-6">
                    @include('components.donut', ['title' => 'By Device Type', 'url' => '/admin/api/v1/visits?group=device_type', 'group' => 'device_type'])
                </div>
            </div>
        </div>
    </section>

@endsection
