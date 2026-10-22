<!DOCTYPE html>
<html>
<head>
    <title>Вход для администратора</title>
    <style>
        body { font-family: Arial; display: flex; justify-content: center; margin-top: 100px; }
        form { background: #f9f9f9; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input { display: block; width: 100%; margin-bottom: 15px; padding: 10px; }
        button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; cursor: pointer; }
        .error { color: red; margin-bottom: 15px; text-align: center; }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('admin.login.process') }}">
        @csrf
        <h2 style="text-align:center">Вход в админ-панель</h2>
        
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <input type="text" name="login" placeholder="Логин (Admin26)" required>
        <input type="password" name="password" placeholder="Пароль (Demo20)" required>
        <button type="submit">Войти</button>
    </form>
</body>
</html>