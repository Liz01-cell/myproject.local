<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Мой сайт')</title>//Директива @yield создает "место" для вставки контента из дочерних шаблонов
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        /* ШАПКА САЙТА */
        header {
            background-color: #0229a8;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo {
            font-size: 24px;
            font-weight: bold;
        }
        header nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
        }
        header nav a:hover {
            text-decoration: underline;
        }
        /* ОСНОВНОЙ КОНТЕНТ */
        main {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            min-height: 400px;
        }
        /* ПОДВАЛ */
        footer {
            background-color: #0229a8;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    {{-- ШАПКА САЙТА --}}
    <header>
        <nav style="display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; background: #00239c; color: white;">
    <div style="font-size: 24px; font-weight: bold;">Мой Laravel </div>
    
    <div style="display: flex; gap: 20px; align-items: center;">
        <a href="{{ route('home') }}" style="color: white; text-decoration: none;">Главная</a>
        <a href="{{ route('about') }}" style="color: white; text-decoration: none;">О нас</a>
        <a href="{{ route('registerForm') }}" style="color: white; text-decoration: none;">Регистрация</a>
        
        {{-- Кнопки для обычных пользователей --}}
        @if(session('user_logged_in')){{--//Директива @if проверяет условие прямо в шаблоне--}}
        {{--проверяем наличие ключа user_logged_in в сессии. Если пользователь успешно вошел (наш AdminController записал это в сессию), --}}
            <span style="color: #0c19ca;"> {{ session('user_name') }}</span>
            <a href="{{ route('dashboard') }}" style="color: white; text-decoration: none;">Кабинет</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf {{--генерирует скрытое поле с уникальным токеном--}}
                <button type="submit" style="background: #f44336; color: white; border: none; padding: 5px 15px; border-radius: 5px; cursor: pointer;">Выйти</button>
            </form>
        @else
            <a href="{{ route('loginForm') }}" style="color: white; text-decoration: none; background: #4CAF50; padding: 5px 15px; border-radius: 5px;">Вход</a>
        @endif

        {{-- Кнопка для администратора --}}
        @if(session('admin_login'))
            <a href="{{ route('admin.panel') }}" style="color: #FFD700; text-decoration: none;">⚙️ Админ-панель</a>
            <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: #f44336; color: white; border: none; padding: 5px 15px; border-radius: 5px; cursor: pointer;">Админ-выход</button>
            </form>
        @else
            <a href="{{ route('admin.login') }}" style="color: white; text-decoration: none; background: #FF9800; padding: 5px 15px; border-radius: 5px;"> Админ</a>
        @endif
    </div>
</nav>
    </header>

    {{-- ОСНОВНОЙ КОНТЕНТ (сюда подставится содержимое дочерних шаблонов) --}}
    {{--Когда открываем страницу, Laravel загружает этот макет, находит директиву @yield('content') и заменяет её на что написано внутри @section('content') ... @endsection в about.blade.php--}}
    <main>
        @yield('content')
    </main>

    {{-- ПОДВАЛ --}}
    <footer>
        <p>© 2026 Мой сайт на Laravel. Все права защищены.</p>
    </footer>

</body>
</html>