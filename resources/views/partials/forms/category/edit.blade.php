{{ csrf_field() }}
{{ method_field('PUT') }}
<div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
    <label for="name">Name</label>
    <input type="name" class="form-control" id="name" name="name" value="{{$category->name}}">
</div>

<button class="btn btn-primary" type="submit">{{$buttonText}}</button>
