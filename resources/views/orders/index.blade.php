@extends('layouts.app')

@section('title', 'Мои заказы')

@section('content')
    <h1>Мои заказы</h1>
    @if ($orders->isEmpty())
        <p>У вас нет заказов.</p>
    @else
        <table class="orders-table">
            <thead>
            <tr>
                <th>Номер заказа</th>
                <th>Дата</th>
                <th>Товары</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $order->orderProducts->map(fn($item) => $item->product->name)->implode(', ') }}</td>
                    <td>{{ $order->total_price }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p><strong>Итоговая стоимость всех заказов:</strong> {{ $totalOrdersPrice }}</p>
    @endif
    <p><a href="{{ route('products.index') }}">Вернуться к каталогу</a></p>
@endsection
