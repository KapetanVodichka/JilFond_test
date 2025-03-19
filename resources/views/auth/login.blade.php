@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <h1>Вход в систему</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" placeholder="Пароль" required>
        </div>
        <button type="submit">Войти</button>
    </form>
    <p>Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></p>
@endsection
