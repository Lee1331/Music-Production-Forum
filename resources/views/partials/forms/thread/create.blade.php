
{{ csrf_field() }}
<div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
    <label for="title">Thread Title</label>
    <input type="text" class="form-control" id="title" name="title">
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control" id="body" name="body"></textarea>
</div>
<div class="form-group">
    <label for="">Category</label>
    <br>
    <select name="category">
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
</div>
<button class="btn btn-primary" type="submit">{{$buttonText}}</button>
