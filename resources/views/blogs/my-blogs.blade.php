@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @includeIf('admin._partials.notification')
                <div class="card">
                    <div class="card-header">My Blogs</div>
                    <div class="card-body">
                        @if($blogs->count()>0)
                            @foreach($blogs as $blog)
                                <div class="blog-item">
                                    <h3>{!! str_limit($blog->title,50) !!}</h3>
                                    {{-- <img src="{!! asset('assets/images/animation-bg.jpg') !!}" class="img-responsive"
                                          style="max-width: 100%;">--}}
                                    {!! $blog->renderPhoto() !!}
                                    <p>{!! strip_tags(str_limit($blog->description,200)) !!}</p>
                                    <p> Posted Date : {!! $blog->posted_date->format('M d, Y') !!}</p>

                                    @if(Auth::id() == $blog->user_id)
                                        <div style="padding: 5px 0 5px 0;">
                                            <a href="{!! route('site.blog-edit',$blog->id) !!}"
                                               class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{!! route('site.blog-delete',$blog->id) !!}"
                                               class="btn btn-danger btn-sm">Delete</a>
                                        </div>
                                    @endif

                                </div>
                            @endforeach
                            {!! $blogs->render() !!}
                        @else
                            <h3>No Record Found</h3>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection