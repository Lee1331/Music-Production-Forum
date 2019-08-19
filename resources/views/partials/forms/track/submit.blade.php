
{{ csrf_field() }}
<div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
    <label for="title">Track Title</label>
    <input type="text" class="form-control" id="title" name="title">
</div>
<div class="form-group {{ $errors->has('genre') ? 'has-error' :'' }}">
    <label for="genre">Genre</label>
    <input type="text" class="form-control" id="genre" name="genre">
</div>
<div class="form-group">
    <label for="track">Upload Track
        <div id="tooltip" style="border-bottom: 3px red dashed; cursor:pointer;">(.ogg)
            <span id="tooltiptext">Due to browser compatibility, we are only accepting .ogg files for now</span>
        </div>
    </label>
    <input type="file" class="form-control" id="track" name="track">
</div>
<button class="btn btn-primary" type="submit">{{$buttonText}}</button>
