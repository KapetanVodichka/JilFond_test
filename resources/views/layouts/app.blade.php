<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Мой магазин</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
    <nav>
        @if (auth()->check())
            <p class="balance">Баланс: {{ auth()->user()->balance }} руб.</p>
            <a href="{{ route('products.index') }}">Каталог</a>
            <a href="{{ route('cart.index') }}">Корзина</a>
            <a href="{{ route('orders.index') }}">Мои заказы</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">Выйти</button>
            </form>
        @else
            <a href="{{ route('login') }}">Вход</a>
            <a href="{{ route('register') }}">Регистрация</a>
        @endif
    </nav>
</header>
<main>
    @yield('content')
</main>
<footer>
    <p>&copy; 2023 Мой магазин</p>
</footer>
</body>
</html>
