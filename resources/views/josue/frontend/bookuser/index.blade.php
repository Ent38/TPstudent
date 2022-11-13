@extends('layouts.frontend.master')

@section('content')
<section id="publication-part" class="pt-115 pb-120 gray-bg">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-6 col-md-8 col-sm-7">
                <div class="section-title pb-60">
                    <h5>Publications</h5>
                    <h2>From Store </h2>
                </div> <!-- section title -->
            </div>

        </div> <!-- row -->
@foreach ($categories as $category )

<div class="col-lg-3 col-md-6 col-sm-8">
    <div class="singel-publication mt-30">
        <div class="image">
            <img src="{{ $category->image() }}" alt="Publication">
        </div>
        <div class="cont">
            <div class="name">
                <a href="{{ route('bookuser.show',$category->id) }}?category_id={{ $category->id }}">
                    <h6>{{$category->name}}</h6>
                </a>
            </div>
        </div>
    </div> <!-- singel publication -->


</div>

@endforeach
</div> <!-- row -->
</div> <!-- container -->
</section>

@endsection
