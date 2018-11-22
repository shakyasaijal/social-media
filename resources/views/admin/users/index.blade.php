@extends('admin.master')
@section('title') list all users @stop
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="left-item" style="float: left;">
                    <h2>List all users</h2>
                </div>
                <div class="right-item" style="float: right;margin-bottom: 5px;">
                    <a href="{!! route('admin.users.create') !!}" class="btn btn-primary">Add New</a>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @includeif('admin._partials.notification')
                    <div class="card">
                        <div class="header">
                            <h2>
                                Users
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
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Avatar</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($users->count()>0) @php $count = 1; @endphp
                                @foreach($users as  $user)
                                    <tr>
                                        <th scope="row">{!! $count !!}</th>
                                        <td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>
                                        <td>{!! $user->address !!}</td>
                                        <td>
                                            <img src="{!! asset($user->avatar) !!}" style="width: 40%;height: 40%;" class="img-responsive img-thumbnail" alt="{!! $user->name !!}">
                                        </td>
                                        <td>
                                            @if($user->roles()->exists())
                                                @foreach($user->roles()->get() as $role)
                                                    <span class="label label-success">{!! $role->name !!}</span>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td style="display: flex;">

                                            <a style="margin-right: 5px;"
                                               href="{!! route('admin.users.edit',$user->id) !!}">
                                                <i class="fa fa-pencil-square-o"></i> Edit
                                            </a>

                                            |
                                            <a href="javascript:void(0)"
                                               onclick="event.preventDefault(); document.getElementById('delete-form{!! $count !!}').submit();">
                                                <i class="fa fa-trash-o"></i> Delete </a>

                                            <form id="delete-form{!! $count !!}"
                                                  action="{!! route('admin.users.destroy',$user->id) !!}" method="POST">
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
                                        <td colspan="7"> No Record Found</td>
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