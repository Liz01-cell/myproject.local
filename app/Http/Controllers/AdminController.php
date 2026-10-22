<?php // главная задача — принимать данные из представлений (View, то есть форм входа), 
// обрабатывать их (проверять пароли, работать с базой данных через Model) 
// и возвращать ответ (перенаправление или ошибку)

namespace App\Http\Controllers;//файл находится в стандартной папке контроллеров
//Подключает класс Request, который необходим для получения данных, отправленных пользователем через форму методом POST
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //  Для обычных пользователей 
    // Обработка входа обычного пользователя
    public function login(Request $request)
    {//Получение данных: $request->input() безопасно извлекает значения из полей формы
        $login = $request->input('login');
        $password = $request->input('password');

        // Ищем пользователя по полю 'login'
        $user = \App\Models\User::where('login', $login)->first();

        // Если пользователь найден и пароль совпадает
        if ($user && \Hash::check($password, $user->password)) {
            // Создаём сессию
            session([
                'user_logged_in' => true,
                'user_name' => $user->full_name,
                'user_id' => $user->id
            ]);

            // Перенаправляем на главную с сообщением
            return redirect('/')->with('success', 'Добро пожаловать, ' . $user->full_name . '!');
        }

        return back()->with('error', 'Неверный логин или пароль!');
    }

    // Выход обычного пользователя
    public function logout()
    {//session()->forget(...): Безопасно удаляет указанные ключи из сессии, фактически "разлогинивая" пользователя
        session()->forget(['user_logged_in', 'user_name']);
        return redirect('/login');//перенаправляет 
    }

    //  Для администратора 
    // Обработка входа администратора
    public function adminLogin(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        if ($login === 'Admin26' && $password === 'Demo20') {
            session(['admin_login' => $login, 'admin_password' => $password]);
            return redirect('/admin/panel')->with('success', 'Добро пожаловать, Администратор!');
        }

        return back()->with('error', 'Неверный логин или пароль!');
    }

    // Админ-панель
    // //метод просто возвращает представление (Blade-шаблон)
    public function panel()
    {//Его защищает Middleware AdminMiddleware, который мы привязали к этому маршруту в файле web.php
        return view('admin.panel');
    }

    // Выход администратора
    public function adminLogout()
    {
        session()->forget(['admin_login', 'admin_password']);
        return redirect('/admin/login');
    }
}