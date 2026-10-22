<?php //Middleware – слой кода, который проверяет и фильтрует входящие HTTP-запросы до того, как они дойдут до контроллера

namespace App\Http\Middleware;//файл находится в стандартной папке Laravel для посредников

use Closure;//middleware переменная $next является замыканием представляет собой следующий шаг в конвейере обработки запроса
use Illuminate\Http\Request;//Подключает класс, который содержит все данные текущего HTTP-запроса

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)//принимает два аргумента: текущий $request и замыкание $next
    {
        $login = session('admin_login');//Проверка данных сессии
        $password = session('admin_password');

        if ($login === 'Admin26' && $password === 'Demo20') {
            return $next($request);
        }

        return redirect('/admin/login')->with('error', 'Доступ запрещён!');//условие if не выполнилось перенаправляем на страницу входа
    }
}