
{{ csrf_field() }}
<div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
    @if($errors->has('email'))
        <span class="help-block">{{$errors->first('email')}}</span>
    @endif
</div>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="name">
    @if($errors->has('name'))
        <span class="help-block">{{$errors->first('name')}}</span>
    @endif
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="password">
    @if($errors->has('name'))
        <span class="help-block">{{$errors->first('password')}}</span>
    @endif
</div>
<div class="form-group">
    <label for="bio">Bio</label>
    <textarea class="form-control" id="bio" rows="2" name="bio" placeholder="bio"></textarea>
</div>
<div class="form-group">
    <label for="profile_image">Profile Image</label>
    <input type="file" class="form-control" id="profile_image" name="profile_image">
</div>
<button class="btn btn-primary" type="submit">{{$buttonText}}</button>


