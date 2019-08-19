
{{ csrf_field() }}
{{ method_field('PUT') }}
<div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
    <label for="title">Title</label>
    <input type="title" class="form-control" id="title" name="title" value="{{$thread->title}}">
</div>
<div class="form-group {{ $errors->has('body') ? 'has-error' :'' }}">
    <label for="body">Body</label>
    <input type="text" class="form-control" id="body" name="body" value="{{$thread->body}}">
</div>

<div class="form-group {{ $errors->has('category') ? 'has-error' :'' }}">
    <label for="">Category</label>
    <br>
    <select name="category">
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
</div>

<button class="btn btn-primary" type="submit">{{$buttonText}}</button>

