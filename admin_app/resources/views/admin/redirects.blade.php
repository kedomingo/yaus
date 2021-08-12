@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Redirects</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Redirects</li>
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
                <div class="col-12">


                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Redirects</h3>

                            <div class="card-tools">
                                <a class="btn btn-primary" href="{{route('redirects.submit')}}">New Redirect</a>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>URI</th>
                                    <th>Target</th>
                                    <th style="width: 40px">Hits</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php /** @var App\Models\Redirect $redirect */ ?>
                                <?php $counter = 1; ?>
                                @foreach($redirects as $redirect)
                                    <tr>
                                        <td>{{$counter++}}.</td>
                                        @if ($redirect->is_active)
                                            <td><a href="{{$redirect->uri}}" target="_blank">{{$redirect->uri}}</a></td>
                                            <td><a href="{{$redirect->destination}}" target="_blank">{{$redirect->destination}}</a></td>
                                        @else
                                            <td>{{$redirect->uri}} (INACTIVE)</td>
                                            <td>{{$redirect->destination}} (INACTIVE)</td>
                                        @endif
                                        <td><span class="badge">{{$redirect->hits}}</span></td>
                                        <td class="text-right"><a class="btn btn-success btn-sm" href="{{route('redirects.update', ['id' => $redirect->id])}}">Edit</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item disabled"><a class="page-link" href="#">1</a></li>
                                <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>
    </section>

@endsection
