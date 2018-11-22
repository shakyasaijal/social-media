<div class="body">
    <div class="form-group">
        <label for="name">Name *</label>
        <div class="form-line">
            <input type="text" name="name" value="{!! isset($user)?$user->name:old('name') !!}" class="form-control"
                   placeholder="Full Name *"/>
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email *</label>
        <div class="form-line">
            <input type="email" name="email" value="{!! isset($user)?$user->email:old('email') !!}" class="form-control"
                   placeholder="Email *"/>
        </div>
    </div>
    <div class="form-group">
        <label for="password">Password *</label>
        <div class="form-line">
            <input type="password" name="password" class="form-control"
                   placeholder="Password *"/>
        </div>
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirm Password *</label>
        <div class="form-line">
            <input type="password" name="password_confirmation"
                   class="form-control" placeholder="Confirm password *"/>
        </div>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <div class="form-line">
            <input type="text" name="address" value="{!! isset($user)?$user->address:old('address') !!}"
                   class="form-control"
                   placeholder="Address"/>
        </div>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <div class="form-line">
            <input type="text" name="phone" value="{!! isset($user)?$user->phone:old('phone') !!}" class="form-control"
                   placeholder="Phone"/>
        </div>
    </div>

    <div class="form-group">
        <label for="avatar">Avatar</label>
        <div class="form-line">
            <input type="file" name="avatar"/>
        </div>
    </div>

    @if(isset($user))
        <div class="form-group">
            <div class="form-line">
                <img src="{!! asset($user->avatar) !!}" class="img-responsive img-thumbnail" alt="{!! $user->name !!}">
            </div>
        </div>
    @endif

    <div class="form-group">
        <label for="roles">Roles</label>
        <div class="form-line">
            <select multiple name="roles[]" style="min-width: 100%;">
                <option>Select Option</option>
                @foreach($roles  as $role)
                    <option value="{{ $role->id }}">
                        {!! ucfirst($role->name) !!}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
    </div>

</div>