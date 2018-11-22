@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Blog') }}</div>

                    <div class="card-body">
                        @includeIf('admin._partials.notification')
                        <form method="POST" action="{{ route('site.blog-update',$blog->id) }}"
                              aria-label="{{ __('Edit Blog') }}"
                              enctype="multipart/form-data">
                            {!! method_field('PUT') !!}
                            @csrf

                            <div class="form-group row">
                                <label for="title"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                           name="title" value="{{ $blog->title?$blog->title:old('title') }}" required
                                           autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="posted_date"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Posted Date') }}</label>

                                <div class="col-md-6">
                                    <input id="datepicker" type="text"
                                           class="form-control{{ $errors->has('posted_date') ? ' is-invalid' : '' }}"
                                           name="posted_date"
                                           value="{{ $blog->posted_date?$blog->posted_date:old('posted_date') }}"
                                           required>

                                    @if ($errors->has('posted_date'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('posted_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="photo"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                                <div class="col-md-6">
                                    <input id="photo" type="file"
                                           class="{{ $errors->has('photo') ? ' is-invalid' : '' }}" name="photo"
                                           >
                                    @if ($errors->has('photo'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @if(isset($blog->photo) && app('files')->exists($blog->photo))
                                <div class="form-group row">
                                    <label for="photo"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Existing Photo') }}</label>
                                    <div class="col-md-6">
                                        <img style="max-width: 100%;" src="{!! asset($blog->photo) !!}" alt="{!! $blog->title !!}"
                                             class="img-responsive"/>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description"
                                              rows="5">
                                        {!! $blog->description?$blog->description:old('description') !!}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                                <div class="col-md-6">
                                    <select name="status" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="1" {!! $blog->status==1?'selected':null !!}>Published</option>
                                        <option value="0" {!! $blog->status==0?'selected':null !!}>Unpublished</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{!! asset('js/jquery.min.js') !!}"></script>
    <script src="{!! asset('js/bootstrap-datepicker.min.js') !!}"></script>
    <script>
        $('#datepicker').datepicker();
    </script>
@stop
@section('styles')
    <link rel="stylesheet" href="{!! asset('css/bootstrap-datepicker.min.css') !!}"/>
@stop
