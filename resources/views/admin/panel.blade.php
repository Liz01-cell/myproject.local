<!DOCTYPE html>
<html>
<head>
    <title>Админ-панель</title>
    <style>
        body { font-family: Arial; padding: 50px; text-align: center; }
        .success { color: green; font-size: 20px; }
        .logout-btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #dc3545; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>🛡️ Административная панель</h1>
    
    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <p>Вы успешно прошли проверку Middleware!</p>
    <p>Логин: <strong>{{ session('admin_login') }}</strong></p>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="logout-btn" style="border:none; cursor:pointer;">Выйти</button>
    </form>
</body>
</html>