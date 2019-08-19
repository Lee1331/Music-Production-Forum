{{ csrf_field() }}
<div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
    <label for="title">Article Title</label>
    <input type="title" class="form-control" id="title" name="title">
</div>
<div class="form-group  {{ $errors->has('header_image') ? 'has-error' :'' }}">
    <label for="header_image">Header Image</label>
    <input type="file" class="form-control" id="header_image" name="header_image">
</div>
<div class="form-group  {{ $errors->has('excerpt') ? 'has-error' :'' }}">
    <label for="excerpt">Article Excerpt</label>
    <textarea class="form-control" id="excerpt" name="excerpt" rows="3"></textarea>
    </div>
    <div class="form-group  {{ $errors->has('body_image') ? 'has-error' :'' }}">
        <label for="body_image">Body Image</label>
    <input type="file" class="form-control" id="body_image" name="body_image">
</div>
<div class="form-group  {{ $errors->has('body') ? 'has-error' :'' }}">
    <div id="app">
    <label for="body">Article Body</label>
    <editor-component name="body"></editor-component>
    </div>
</div>
<div class="form-group  {{ $errors->has('tags') ? 'has-error' :'' }}">
    <label for="tags">Tags</label>
    <select class="form-control select2-multi" multiple="multiple" name="tags[]">
        @foreach($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach
    </select>
    <script>
        $('.select2-multi').select2();
    </script>
</div>

<button class="btn btn-primary" type="submit">{{$buttonText}}</button>
