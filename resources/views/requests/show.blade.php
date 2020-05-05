@extends('layout.app')

@section('contents')
<h1>{{$requests->item->title}}</h1>
<hr>
<a href="/requests" class="btn btn-secondary">Back</a>
<br><br>
<h5>Requested by {{$requests->user->name}}</h5>
<br>
<div>
    <b>Reason:</b>
        {!!$requests->reason!!}
</div>
<hr>
<small>Request made on: {{$requests->created_at}}</small>
<hr>
@if(Auth::user()->role == 1)
    <div>
        <a href="{{action('RequestController@approveRequest', $requests->id)}}" class="btn btn-primary">Accept</a>
        <a href="{{action('RequestController@disapproveRequest', $requests->id)}}" class="btn btn-danger">Decline</a>
    </div>
@endif
@endsection