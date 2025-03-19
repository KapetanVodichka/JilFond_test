@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    <h1>Корзина</h1>
    @if ($cartProducts->isEmpty())
        <p>Ваша корзина пуста.</p>
    @else
        <table class="cart-table">
            <thead>
            <tr>
                <th>Товар</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cartProducts as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->product->price }}</td>
                    <td>{{ $item->product->price * $item->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p><strong>Общая стоимость:</strong> {{ $total }}</p>
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <button type="submit">Оформить заказ</button>
        </form>
    @endif
    <p><a href="{{ route('products.index') }}">Вернуться к каталогу</a></p>
@endsection
