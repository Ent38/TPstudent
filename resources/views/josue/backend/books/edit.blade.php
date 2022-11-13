@extends('layouts.backend.master')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Forms</a></li>
                        <li class="active">Basic</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-10 m-auto py-2">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Credit Card</strong>
                    </div>
                    <div class="card-body">
                        <!-- Credit Card -->
                        <div id="pay-invoice">
                            <div class="card-body">
                                <form action="{{ route('books.update',[$book->id]) }}" method="post"
                                    novalidate="novalidate" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="category" class="control-label mb-1">@lang('category')</label>
                                                <select name="category" id="category" class="form-control">
                                                    <option value="">@lang('Select category')</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $id }}">{{ $categories->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('Category')
                                                <div class="help-block field-validation-valid alert alert-danger">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-success">
                                                <label for="name" class="control-label mb-1">@lang('Full Name')</label>
                                                <input id="name" name="name" type="text"
                                                    value="{{ $book->name }}" class="form-control name valid"
                                                    data-val="true" data-val-required="{{ __('Please enter category name') }}"
                                                    autocomplete="name" aria-required="true" aria-invalid="false"
                                                    aria-describedby="name-error">
                                                <span class="help-block field-validation-valid" data-valmsg-for="name"
                                                    data-valmsg-replace="true"></span>
                                            </div>
                                            @error('name')
                                                <div class="help-block field-validation-valid alert alert-danger">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-success">
                                                <label for="nfc" class="control-label mb-1">@lang('Number of chapters')</label>
                                                <input id="nfc" name="nfc" type="int"
                                                    class="form-control username valid" data-val="true"
                                                    data-val-required="{{ __('nUmber of chapters') }}"
                                                    autocomplete="nfc" aria-required="true" aria-invalid="false"
                                                    aria-describedby="nfc-error">
                                                <span class="help-block field-validation-valid" data-valmsg-for="nfc"
                                                    data-valmsg-replace="true"></span>
                                            </div>
                                            @error('nfc')
                                                <div class="help-block field-validation-valid alert alert-danger">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">@lang('image')</label>
                                                <input id="image" name="image" type="file"
                                                    class="form-control image" value="" autocomplete="image">

                                            </div>
                                            @error('image')
                                                <div class="help-block field-validation-valid alert alert-danger">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label for="x_card_code" class="control-label mb-1">@lang('Status')</label>
                                            <div class="input-group">
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">@lang('Select Status')</option>
                                                    <option value="enabled">@lang('Enabled')</option>
                                                    <option value="disabled">@lang('Disabled')</option>
                                                </select>
                                            </div>
                                            @error('status')
                                                <div class="help-block field-validation-valid alert alert-danger">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <i class="fa fa-save fa-lg"></i>&nbsp;
                                            <span id="payment-button-amount">@lang('edit category')</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div> <!-- .card -->

            </div>
            <!--/.col-->
        </div>
    </div><!-- .animated -->
@endsection
