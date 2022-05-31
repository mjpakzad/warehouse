@extends('layouts.app')
@section('styles')
    <style>
        body {
            direction: ltr;
            text-align: left;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Result</h1>
                <h2 class="mt-3">Products:</h2>
            </div>
        </div>
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['name'] }}</h5>
                            <p class="card-text">
                                <span>{{ __('Price') }}:</span>
                                <strong>{{ $product['price'] }}</strong>
                                <br>
                                <span>{{ __('Stock') }}:</span>
                                <strong>{{ $product['stock'] }}</strong>
                            </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($product['articles'] as $article)
                            <li class="list-group-item">{{ $article['amount'] }} {{ $articles[$article['id']]['name'] }}{{ $article['amount'] > 1 ? 's' : '' }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger">
                    <p>{{ __('There is no product.') }}</p>
                </div>
            @endforelse
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-3">Article:</h2>
            </div>
        </div>
        <div class="row">
            @forelse($articles as $article)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article['name'] }}</h5>
                            <p class="card-text">
                                <span>{{ __('Stock') }}:</span>
                                <strong>{{ $article['stock'] }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger">
                    <p>{{ __('There is no article.') }}</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
