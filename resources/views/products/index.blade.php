@extends('layouts.app')

@section('title', 'Каталог товаров')

@section('content')
    <h1>Каталог товаров</h1>
    @foreach($products as $product)
        <div class="product-item">
            <h2>{{ $product->name }}</h2>
            <p><strong>Цена:</strong> {{ $product->price }}</p>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <label>
                    Количество: <input type="number" name="quantity" value="1" min="1">
                </label>
                <button type="submit">Добавить в корзину</button>
            </form>
        </div>
    @endforeach
    <p><a href="{{ route('cart.index') }}">Перейти в корзину</a></p>
@endsection
