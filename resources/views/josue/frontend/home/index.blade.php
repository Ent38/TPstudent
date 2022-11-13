@extends('layouts.frontend.master')

@section('content')
    <!--====== SEARCH BOX PART ENDS ======-->

    <!--====== SLIDER PART START ======-->
    @include('josue.frontend.home.slider')


    <!--====== SLIDER PART ENDS ======-->

    <!--====== ABOUT PART START ======-->
    @include('josue.frontend.home.about')


    <!--====== ABOUT PART ENDS ======-->

    <!--====== APPLY PART START ======-->

    @include('josue.frontend.home.apply')


    <!--====== APPLY PART ENDS ======-->


    <!--====== PUBLICATION PART START ======-->

    @include('josue.frontend.lessons.index')


    <!--====== PUBLICATION PART ENDS ======-->


@endsection
