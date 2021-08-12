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


                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create a new Short URL</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('redirects.submit')}}">
                            <input type="hidden" name="id" value="{{$request->id}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="uri">Short URL</label>
                                    <input type="text" class="form-control" id="uri" name="uri"
                                           value="{{$redirect->uri ?? old('uri')}}"
                                           placeholder="Short URL">
                                    @if ($errors->has('uri'))
                                        <span class="bg-danger">{{ $errors->first('uri') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="destination">Full Destination URL</label>
                                    <input type="text" class="form-control" id="destination" name="destination"
                                           value="{{$redirect->destination ?? old('destination')}}"
                                           placeholder="Full URL">
                                    @if ($errors->has('destination'))
                                        <span class="bg-danger">{{ $errors->first('destination') }}</span>
                                    @endif
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="active" name="active"
                                        {{ !empty($redirect) ? ($redirect->is_active? 'checked' : '') : 'checked'  }}>
                                    <label class="form-check-label" for="active">Active?</label>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-default" href="{{route('redirects.index')}}">Cancel</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
