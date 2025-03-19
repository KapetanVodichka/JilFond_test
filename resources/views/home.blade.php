@extends('layouts.app')

@section('title', 'Домашняя')

@section('content')
    <h1>Добро пожаловать, {{ auth()->user()->name }}!</h1>
    <p><a href="{{ route('products.index') }}">Перейти к каталогу товаров</a></p>
    <p><a href="{{ route('orders.index') }}">Мои заказы</a></p>
@endsection
