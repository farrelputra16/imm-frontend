@extends('layouts.app-table')

<style>
    .product-section {
        text-align: center;
        margin-top: 50px;
    }

    .product-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .product-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 400px;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
    }

    .product-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        margin-bottom: 1rem;
    }

    .team-name {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .product-description {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 1rem;
        font-weight: bold;
    }
    .product-price{
        margin: 20px;
        border: none;
        background-color: #5940cb;
        padding: 10px;
        padding-left: 20px;
        padding-right: 20px;
        color: white;
        border-radius: 30px;
    }   
</style>

@section('content')
<div class="container my-5 product-section">
    <h2 class="text-center mb-4">Meet Our Team</h2>
    <div class="product-container">
        @foreach ($products as $product)
            <div class="product-card">
                <img src="{{ isset($product->image) ? asset('images/products/' . $product->image) : asset('images/imm.png') }}" alt="{{ $product->name }}">
                <div class="team-name">{{ $product->name }}</div>
                <div class="product-description">{{ $product->description }}</div>
                <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
            </div>
        @endforeach
    </div>
</div>
@endsection
