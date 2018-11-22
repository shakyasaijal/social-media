@extends('admin.master')
@section('title') list of all blogs @stop
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="left-item" style="float: left;">
                    <h2>List of all blogs</h2>
                </div>
                <div class="right-item" style="float: right;margin-bottom: 5px;">
                    <a href="{!! route('admin.blog.create') !!}" class="btn btn-primary">Add New</a>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @includeif('admin._partials.notification')
                    <div class="card">
                        <div class="header">
                            <h2>
                                Blogs
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a>
                                        </li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another
                                                action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something
                                                else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Title</th>
                                    <th>Posted Date</th>
                                    <th >Photo</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($blogs->count()>0)
                                    @php $count = 1; @endphp
                                @foreach($blogs as  $blog)
                                    <tr>
                                        <th scope="row">{!! $count !!}</th>
                                        <td>{!! $blog->title !!}</td>
                                        <td>{!! $blog->posted_date->format('M d, Y') !!}</td>
                                        <td width="25%">{!! $blog->renderPhoto() !!}</td>
                                        <td>
                                           {!! $blog->status() !!}
                                        </td>

                                        <td style="display: flex;">

                                            <a style="margin-right: 5px;"
                                               href="{!! route('admin.blog.edit',$blog->id) !!}">
                                                <i class="fa fa-pencil-square-o"></i> Edit
                                            </a>

                                            |
                                            <a href="javascript:void(0)"
                                               onclick="event.preventDefault(); document.getElementById('delete-form{!! $count !!}').submit();">
                                                <i class="fa fa-trash-o"></i> Delete </a>

                                            <form id="delete-form{!! $count !!}"
                                                  action="{!! route('admin.blog.destroy',$blog->id) !!}" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                {{-- <button type="submit" class="btn btn-danger">Delete</button>--}}
                                            </form>

                                        </td>
                                    </tr>
                                    @php $count ++; @endphp
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="6"> No Record Found</td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@stop