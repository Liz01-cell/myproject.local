@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <h1>Форма регистрации</h1>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <p>
            <label>Логин:</label><br>
            <input type="text" name="login" required>
        </p>
        <p>
            <label>Email:</label><br>
            <input type="email" name="email" required>
        </p>
        <p>
            <label>ФИО:</label><br>
            <input type="text" name="full_name" required>
        </p>
        <p>
            <label>Телефон:</label><br>
            <input type="tel" name="phone" required>
        </p>
        <p>
            <label>Пароль:</label><br>
            <input type="password" name="password" required>
        </p>
        <p>
            <button type="submit">Зарегистрироваться</button>
        </p>
    </form>
@endsection