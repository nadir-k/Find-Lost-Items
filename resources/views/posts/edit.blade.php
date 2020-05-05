@extends('layout.app')

@section('contents')
<h1>Edit post</h1>

<div class="p-2">
    <h5>Fill the details below</h5>
</div>

<form method="POST" action="{{route('posts.update', $posts->id)}}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
    <textarea type="text" style="resize: none;" rows="1" class="form-control" name="title">{{$posts->title}}</textarea>
    </div>
    <div class="form-group has-error">
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
        <textarea id="summary-ckeditor" class="form-control" name="description" cols="30" rows="10" placeholder="Enter Description Here!">{{$posts->description}}</textarea>
    </div>
    <div class="form-group">
        <label for="colour">Colour</label>
        <textarea type="text" rows="1" style="resize: none;" class="form-control" name="colour" >{{$posts->colour}}</textarea>
    </div>
    <div class="form-group">
        <label for="found_location">Found Location</label>
    <textarea type="text" rows="1" style="resize: none;" class="form-control" name="found_location">{{$posts->found_location}}</textarea>
    </div>
    <div class="form-group">
        <input type= "file" name="cover_image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection