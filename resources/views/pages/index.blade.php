@extends('layout.app')

@section('contents')
<div class="container">
    <div class="text-center">
        <h1>Welcome to FiLo</h1>
        <hr>  
    </div>   

    <div class="shadow-lg p-5 mb-4 bg-white rounded text-center">
        <p class="h5">This is a page where you can report your lost items found, or even request an item that belongs to you.</p>
        <br>
        <span> By Mohammed Nadir Khan | 180106330 </span>
        <br><br>
        @if(!Auth::guest())
            @if(Auth::user()->role == 1)
                <p class="h6">This is an admin page</p>
            @endif
        @else
        <a class="btn btn-primary btn-lg"href="{{ route('login') }}" role="button">Login</a> <a class="btn btn-success btn-lg"href={{ route('register') }} role="button">Register</a>
        @endif 
    </div>

    <div class="shadow-lg p-5 mb-4 bg-white rounded">
        <div class="text-center">
            <p class="h4">
                Have you lost an item?
                <br><br>
            </p> 
        </div>
        <p class="h4"> 
            Well you could be in luck because maybe
            someone has been as lucky to report your item found here.
        </p>
        <br>
        <div class="text-center">
            <a class="btn btn-primary btn-lg"href="{{route('about')}}" role="button">Learn More</a>
        </div>
    </div>
</div>

@endsection
