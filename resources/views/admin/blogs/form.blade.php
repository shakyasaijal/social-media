<div class="body">
    <div class="form-group">
        <label for="name">Title *</label>
        <div class="form-line">
            <input type="text" name="title" value="{!! isset($blog)?$blog->title:old('title') !!}" class="form-control"
                   placeholder="Title *"/>
        </div>
    </div>
    <div class="form-group">
        <label for="posted_date">Posted Date *</label>
        <div class="form-line">
            <input type="text" name="posted_date" value="{!! isset($blog)?$blog->posted_date:old('posted_date') !!}"
                   class="form-control"
                   placeholder="Posted date *"/>
        </div>
    </div>
    <div class="form-group">
        <label for="photo">Photo *</label>
        <div class="form-line">
            <input type="file" name="photo">
        </div>
    </div>

    @if(isset($blog))
        <div class="form-group">
            <div class="form-line">
                <img src="{!! asset($blog->photo) !!}" class="img-responsive img-thumbnail" alt="{!! $blog->title !!}">
            </div>
        </div>
    @endif

    <div class="form-group">
        <label for="address">Description *</label>
        <div class="form-line">
            <textarea name="description" class="form-control" rows="7">
                {!! isset($blog->description)?$blog->description:old('description') !!}
            </textarea>
        </div>
    </div>


    <div class="form-group">
        <label for="roles">Status * </label>
        <div class="form-line">
            <select name="status" style="min-width: 100%;">
                <option>Select Option</option>

                <option value="1" {!! isset($blog)?$blog->status===1?'selected="selected"':'':"" !!}>
                   Active
                </option>

                    <option value="0" {!! isset($blog)?$blog->status===0?'selected="selected"':'':"" !!}>
                       Inactive
                    </option>

            </select>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
    </div>

</div>