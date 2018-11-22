@extends('admin.master')
@section('title') Edit user @stop
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="left-item" style="float: left;">
                    <h2>Edit user</h2>
                </div>
                <div class="right-item" style="float: right;margin-bottom: 5px;display: flex;">
                    <a href="{!! route('admin.users.create') !!}" class="btn btn-primary" style="margin-right: 3px;">Add
                        New</a>
                    <a href="{!! route('admin.users.index') !!}" class="btn btn-primary">List all</a>
                </div>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Edit</h2>
                            <div class="row clearfix">
                                @includeif('admin._partials.notification')
                                <div class="col-sm-12">
                                    <div class="card">
                                        <form role="form" action="{!! route('admin.users.update',$user->id) !!}"
                                              method="POST" enctype="multipart/form-data">
                                            {{ method_field('PUT') }}
                                            @csrf
                                            @includeif('admin.users.form')
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop