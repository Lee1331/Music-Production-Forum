
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
    </div>
    <div class="form-group">
        <label for="bio">Bio</label>
        <input type="text" class="form-control" id="bio" name="bio" value="{{$user->bio}}">
    </div>
    <div class="form-group">
        <label for="profile_image">Profile Image</label>
        <input type="file" class="form-control" id="profile_image" name="profile_image" value="{{$user->profile_image}}">
    </div>
    <button class="btn btn-primary" type="submit">{{$buttonText}}</button>
