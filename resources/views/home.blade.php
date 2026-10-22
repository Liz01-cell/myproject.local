{{--Его задача — использовать общий макет (layout), выводить сообщения от контроллера и показывать контент в зависимости вошел пользователь в систему или нет--}}
@extends('layouts.app'){{-- говорит Laravel: "Возьми файл layouts/app.blade.php как основу для этой страницы"--}}

@section('title', 'Главная страница'){{-- переопределяем заголовок страницы--}}

@section('content'){{--что находится внутри этой секции, Laravel вставит вместо директивы @yield('content') в главном макете--}}
    
    {{-- БЛОК ДЛЯ СООБЩЕНИЙ (Успех или Ошибка)--}}
    
    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb; font-weight: bold;">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb; font-weight: bold;">
            ❌ {{ session('error') }}
        </div>
    @endif

    
    
    
    <h1>Добро пожаловать на наш сайт!</h1>
    <p>Это главная страница, которая использует общий layout с шапкой.</p>
    <p>Шапка и подвал определены в файле <code>layouts/app.blade.php</code>.</p>
    <p>А этот контент подставляется через директиву <code>@yield('content')</code>.</p>

    
    {{-- ПРОВЕРКА СТАТУСА АВТОРИЗАЦИИ--}}
    {{--проверяем кастомный ключ сессии user_logged_in, который  AdminController создает при успешном входе--}}
    @if(session('user_logged_in'))
        <hr>
        <p style="color: #28a745; font-weight: bold; font-size: 18px;">
            🟢 Статус: Вы успешно вошли в систему!
        </p>
        <p>Ваше имя: <strong>{{ session('user_name') }}</strong></p>
        <p>Теперь вам доступны защищённые страницы: 
            <a href="{{ route('dashboard') }}" style="color: #007bff;">Личный кабинет (Dashboard)</a>
        </p>
    @else
        <hr>
        <p style="color: #6c757d;">
            ⚪ Статус: Вы не авторизованы. 
            <a href="{{ route('loginForm') }}" style="color: #007bff;">Войти в профиль</a>
        </p>
    @endif

@endsection