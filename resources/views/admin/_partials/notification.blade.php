@if(session()->has('success'))
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {!! session()->get('success') !!}
        </div>
    </div>
@endif
@if(session()->has('error'))
    <div class="col-md-12">
        <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> {!! session()->get('error') !!}
        </div>
    </div>
@endif
@if($errors->any())
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li style="color:#fff;">{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif