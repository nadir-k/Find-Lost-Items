@extends('layout.app')
  @section('contents')
  <h1>About</h1>
  <hr>

  <div class="shadow-lg p-3 mb-4 bg-white rounded">
    <br>
    <p class="h4">
      Here we have various items that you can declare found.
      <br><br>
      Additionally, you may be in luck as someone may have found your item so you can make a request
      to retrieve it provided it does belong to you.
      <br><br>
      There are 3 categories of posts:
      <br><br>
    </p>
    <ul>
      <li class="h5">Pets</li>
      <li class="h5">Phones</li>
      <li class="h5">Jewellery</li>
    </ul>
  </div>

  <br>
  <p class="h3">Categories</p>
  <hr>
  <br>
  <div id="demo" class="carousel slide shadow-lg p-3 mb-4 rounded" data-ride="carousel">
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <p class="h4">Pets</p>
        <img src="{{asset('img/pets.jpg')}}" href="/posts/pets" alt="Los Angeles" width="1100" height="500">
      </div>
      <div class="carousel-item">
        <p class="h4">Phones</p>
        <img src="{{asset('img/phones.jpg')}}" alt="Chicago" width="1100" height="500">
      </div>
      <div class="carousel-item">
        <p class="h4">Jewellery</p>
        <img src="{{asset('img/jewellery.jpg')}}" alt="New York" width="1100" height="500">
      </div>
    </div>
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
  <br>
  @endsection