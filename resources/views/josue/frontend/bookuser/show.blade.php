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

<div class="col-lg-3 col-md-6 col-sm-8">
    <div class="singel-publication mt-30">
        <div class="image">
            <img src="{{ $book->image() }}" alt="Publication">
        </div>
        <div class="cont">
            <div class="name">
                <a href="shop-singel.html">
                    <h6>{{$book->name}}</h6>
                </a>
            </div>
        </div>
    </div> <!-- singel publication -->
</div>

<form action="{{ route('bookuser.store') }}" method="post"
                    novalidate="novalidate" enctype="multipart/form-data">
                    @csrf
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="select" class=" form-control-label">Select</label></div>
                            <div class="col-12 col-md-9">
                                <label for="name" class="control-label mb-1">@lang('Full Name')</label>
                                <select aria-required="true" aria-invalid="false" name="chap_num" id="chap_num" class="form-control">



                    @for ($i = 1; $i <= $nfc; $i++)

                                    <option id="chap_num" name="chap_num"value="{{ $i}}">chapter {{ $i }}</option>
                    @endfor
                                </select>
                            </div>
                        </div>
                    <div >
                        <button id="payment-button" type="submit" class="pull-right btn btn-sm btn-success">
                            <i class="main-btn"></i>&nbsp;
                            <span id="payment-button-amount">@lang('finished Read')</span>

                        </button>
                    </div>
                </form>

@endforeach

</div> <!-- row -->
</div> <!-- container -->
</section>

@endsection
