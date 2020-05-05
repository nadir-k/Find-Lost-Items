@extends('layout.app')
@section('contents')
<h1>Requests</h1>
<hr>
<br>
<div class="shadow-lg p-3 mb-4 bg-white rounded">
        <table class="table table-bordered border-dark">
            <br>
            <thead class="bg-dark text-white">
                <tr>
                    @if(Auth::user()->role == 1)
                    <th scope="col">Name</th>
                    @endif
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    @if(Auth::user()->role == 1)
                        <th scope="col">Request Decision</th>
                    @endif

                </tr>
            </thead>
            @if(count($requests) > 0)
                @foreach($requests as $request)
                    @if(Auth::user()->id == $request->user_id || Auth::user()->role == 1)
                    <tbody>
                        <tr>
                            @if(Auth::user()->role == 1)
                            <td>
                                <p>{{$request->user->name}}</p>
                            </td>
                            @endif
                            <td>
                                <a href='{{url("showRequest/{$request->id}")}}'>{{$request->item->title}}</a>
                            </td>
                            <td>
                                <p>{{$request->status}}</p>
                            </td>
                            @if(Auth::user()->role == 1)
                                @if($request->status == 'Pending')
                                <td>
                                    <a href="{{action('RequestController@approveRequest', $request->id)}}" class="btn btn-primary">Approve Request</a>
                                    <a href="{{action('RequestController@disapproveRequest', $request->id)}}" class="btn btn-danger">Decline</a>
                                </td>
                                @else
                                <td>
                                    Request resolved
                                </td>
                                @endif
                            @endif
                        </tr>
                    </tbody>
                    @endif
                @endforeach
        </table>
    </div>
    @else
        <p>No Requests to show!</p>
    @endif
@endsection
