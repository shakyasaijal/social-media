@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $blog->title }}</div>

                    <div class="blog-image">
                        <div class="figure ">
                            <img src="{!! $blog->getFullPhotoPath() !!}" style="margin-left:50%;margin-right:50%" alt="{!! $blog->title !!}"/>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
               <div class="card ">
                <div class="blog-detail">
                    <p> Posted Date : {!! $blog->posted_date !!} </p>
                    <div>{!! $blog->description !!} </div>
                    <span class="posted-by">Posted By : {!! $blog->user->name !!}</span>
                    <like-dislike v-bind:blog_id="{!! $blog->id !!}"></like-dislike>
                </div>
                
               </div>
            </div>
            <div class="col-md-8">
                <div class="comment-section">
                    <main role="main" class="container bootdey.com">
                        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-blue rounded box-shadow">
                            <img class="mr-3" src="{!! auth()->user()->getFullPhotoPath() !!}" alt=""
                                 width="48" height="48">
                            <div class="lh-100">
                                <h6 class="mb-0 text-white lh-100">{!! auth()->user()->name !!}</h6>
                                <small>{!! auth()->user()->email !!}</small>
                            </div>
                        </div>
                        <div class="my-3 p-3 bg-white rounded box-shadow">
                            <h6 class="border-bottom border-gray pb-2 mb-0">Comments</h6>
                            <comments v-bind:blog_id="{!! $blog->id !!}"></comments>
    
                        </div>
                        <add-comment v-bind:blog_id="{!! $blog->id !!}"></add-comment>
                    </main>
                </div>
            </div>
        </div>
    </div>
@stop

@section('styles')
    <style>
        .figure, .blog-detail {
            max-width: 100%;
            margin: auto auto;
            padding: 20px;
        }

        .posted-by {
            width: 100%;
            display: block;
            margin-top: 5px;
            padding: 5px;
            background: #ddd;
        }

        .text-white-50 {
            color: rgba(255, 255, 255, .5);
        }

        .bg-blue {
            background-color: #00b5ec;
        }

        .border-bottom {
            border-bottom: 1px solid #e5e5e5;
        }

        .box-shadow {
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
        }

        .lh-100 small {
            color: #fff;
        }

        main {
            padding-bottom: 15px;
        }
    </style>
@stop