
@extends('layouts.frontend.master')

@section('content')

@foreach ($categories as $category )



<div class="col-lg-3 col-md-6 col-sm-8">
    <div class="singel-publication mt-30">
        <div class="image">
            <img src="{{ $category->image }}" class="user-avatar rounded-circle mr-3">
        </div>
        <div class="cont">
            <div class="name">
                <a href="shop-singel.html">
                    <h6>{{$category->name}}</h6>
                </a>

            </div>
            <div class="button text-right">
                <a href="" class="main-btn">lecture level</a>
            </div>
        </div>
    </div> <!-- singel publication -->
</div>

@endforeach

@endsection
