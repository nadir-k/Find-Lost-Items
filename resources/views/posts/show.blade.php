@extends('layout.app')

@section('contents')
    <h1>{{$posts->title}}</h1>
    <hr>
    <div class="p-3 mb-4 bg-white rounded">
        <div class="row">
            <div class="col-md-4 col-sm-3">
                <img class="img-thumbnail" style="width:100% height:100%" src="/storage/cover_images/{{$posts->cover_image}}" height="300" width="300">
            </div>
            <br><br>
            <div class="col-md-5 col-sm-5">
                <div>
                    <br>
                    <b class="h5">Type:</b>
                    <p>{{$posts->type}}</p>
                </div>
                <div>
                    <b class="h5">Colour:</b>
                    <p>{{$posts->colour}}</p>
                </div>
                <div>
                    <b class="h5">Found Location:</b>
                    <p>{{$posts->found_location}}</p>
                </div>
                <div>
                    <b class="h5">Description:</b> 
                    {!!$posts->description!!}
                </div>
            </div>
        </div>
    </div>

    <hr>
    <small class="h6">Written on: {{$posts->created_at}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $posts->user_id)
        <div>
            <a href="/posts/{{$posts->id}}/edit" class="btn btn-primary">Edit</a>
            {!!Form::open(['action' => ['PostController@destroy', $posts->id], 'method' => 'POST', 'class' => 'text-right float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger pull-right'])}}
            {!!Form::close() !!}
        </div>
        @endif
        <!-- allows the admin to edit the post -->
        @if(Auth::user()->role == 1)
        <div>
            <a href="/posts/{{$posts->id}}/edit" class="btn btn-primary">Edit</a>
        </div>
        @endif
    @endif
@endsection