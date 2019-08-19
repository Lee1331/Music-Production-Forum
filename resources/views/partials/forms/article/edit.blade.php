<form action="{{ action('Backend\Admin\ArticleController@update', ['title' => $article->title]) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
        <label for="title">Article Title</label>
        <input type="title" class="form-control" id="title" name="title" value="{{$article->title}}">
    </div>
    <div class="form-group  {{ $errors->has('header_image') ? 'has-error' :'' }}">
        <label for="header_image">Header Image</label>
        <input type="file" class="form-control" id="header_image" name="header_image" value="{{$article->header_image}}">
    </div>
    <div class="form-group  {{ $errors->has('excerpt') ? 'has-error' :'' }}">
        <label for="excerpt">Article Excerpt</label>
        <textarea class="form-control" id="excerpt" name="excerpt" rows="3">{{$article->excerpt}}</textarea>
    </div>
    <div class="form-group {{ $errors->has('body') ? 'has-error' :'' }}">

        <div id="app">
            <label for="body">Article Body</label>
            <editor-component name="body" value="{!! $article->body !!}"></editor-component>
        </div>
    </div>
    <div class="form-group  {{ $errors->has('body_image') ? 'has-error' :'' }}">
        <label for="body_image">Body Image</label>
        <input type="file" class="form-control" id="body_image" name="body_image" value="{{$article->body_image}}">
    </div>
    <div class="form-group  {{ $errors->has('tags') ? 'has-error' :'' }}">
        <label for="tags">Tags</label>
        <select class="form-control select2-multi" multiple="multiple" name="tags[]" value="">
            @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
        </select>
        <script>
            $('.select2-multi').select2();
            $('.select2-multi').select2().val({!! json_encode($article->tags()->allRelatedIds())!!}).trigger('change');
        </script>
    </div>
    <button class="btn btn-primary" type="submit">{{$buttonText}}</button>
</form>
