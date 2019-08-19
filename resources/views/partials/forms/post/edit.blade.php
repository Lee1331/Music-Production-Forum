{{ csrf_field() }}
{{ method_field('PUT') }}
<div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
    <label for="title">Title</label>
    <input type="title" class="form-control" id="title" name="title" value="{{$post->title}}">
</div>
<div class="form-group {{ $errors->has('body') ? 'has-error' :'' }}">
    <label for="body">Body</label>
    <input type="text" class="form-control" id="body" name="body" value="{{$post->body}}">
</div>

<button class="btn btn-primary" type="submit">Update Post</button>
