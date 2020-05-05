<!-- design of the create form page -->
@extends('layout.app')

@section('contents')
<h1>Create a post</h1>

<div class="p-2">
    <h5>Fill the details below</h5>
</div>

<form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Title">
    </div>
    <div class="form-group">
        <label for="sel1">Select Type:</label>
        <select name="type_id" class="browser-default custom-select" id="sel1">
            @if(count($categories) > 0)
            <option selected>Open this select menu</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{$category->type}}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="summary-ckeditor" class="form-control" name="description" cols="30" rows="10" placeholder="Enter Description Here!"></textarea>
    </div>
    <div class="form-group">
        <label for="colour">Colour</label>
        <input type="text" class="form-control" name="colour">
    </div>
    <div class="form-group">
        <label for="found_location">Found Location</label>
        <input type="text" class="form-control" name="found_location">
    </div>
    <div class="form-group">
        <input type= "file" name="cover_image">
    </div>
    <button type="submit" class="btn btn-primary" >Submit</button>
</form>
<br>

@endsection
