{{ csrf_field() }}
<div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
    <label for="name">Name</label>
    <input type="name" class="form-control" id="name" name="name">
</div>
<button class="btn btn-primary" type="submit">{{$buttonText}}</button>
