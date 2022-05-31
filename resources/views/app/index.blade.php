@extends('layouts.app')
@section('content')
    <form class="form-warehouse" method="post" action="{{ route('app.process') }}" enctype="multipart/form-data">
        @csrf
        <div class="text-center mb-4">
            <img class="mb-4" src="{{ asset('images/logo.png') }}" alt="{{ __('Logo') }}" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">{{ __('Warehouse web application') }}</h1>
            <p>{{ __('Please upload products.json and articles.json using the following form.') }}</p>
        </div>

        @include('partials.input-errors')

        <div class="form-group">
            <label for="products">{{ __('products.json file') }}</label>
            <input type="file" class="form-control-file" id="products" name="products">
        </div>

        <div class="form-group">
            <label for="articles">{{ __('articles.json file') }}</label>
            <input type="file" class="form-control-file" id="articles" name="articles">
        </div>

        <button class="btn btn-lg btn-success btn-block" type="submit">{{ __('Process') }}</button>
    </form>
@endsection
