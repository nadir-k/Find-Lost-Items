@extends('layout.app')
@section('contents')
<h1>Select Item Category</h1>
    <br>
    <ul class="text-center">
        @if(count($categories) > 0)
            @foreach($categories as $category)
                <a href='{{ url("category/{$category->id}") }}' style="height:5vh;margin:1%;" class="btn btn-outline-secondary btn-lg text-center">{{$category->type}}</a>
            @endforeach
        @else
            <p>No Category Found!</p>
        @endif
    </ul>

<br><br><hr>
    <h1>Lost Items</h1>
    <hr>
    <br>
    @if(count($posts) > 0)
        @foreach ($posts as $post)
        <div class="shadow-lg p-3 mb-4 bg-white rounded">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <img class="img-thumbnail" style="width:100% height:100%" src="{{$post->cover_image}}" height="200" width="200">
                </div>
                <div class="col-md-5 col-sm-5">
                    <h3><a href='{{url("show/{$post->id}")}}' >{{$post->title}}</a></h3>
                    <small>Written on: {{$post->created_at}}</small>
                    <br>
                    @if(!Auth::guest())
                        @if(Auth::user()->id != $post->user_id && Auth::user()->role != 1)
                            <a href='{{url("makeRequest/{$post->id}")}}' class="btn btn-primary">Request</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    @else
        <p>No posts to show!</p>
    @endif
@endsection