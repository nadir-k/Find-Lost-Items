@extends('layout.app')

@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="h5 text-white bg-primary card-header">Dashboard</div>
                <div class="card-body">
                    <div class="panel-body">
                        <a href="{{route('create')}}" class="btn btn-primary">Create Post</a>
                        <br><br>
                        <h3>Your Blog Posts</h3>
                        <br>
                        @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <th><h5><a href='{{url("show/{$post->id}")}}'>{{$post->title}}</a></h5></th>
                                    <th><a href='{{url("edit/{$post->id}")}}' class="btn btn-info">Edit</a></th>
                                    <th>
                                        {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'text-right float-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger pull-right'])}}
                                        {!!Form::close() !!}
                                    </th>
                                </tr>
                            @endforeach
                        </table>
                        @else 
                            <p>No Posts Available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
