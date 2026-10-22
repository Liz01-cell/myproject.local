<?php //контроллер, который управляет логикой регистрации пользователей

namespace App\Http\Controllers;//namespace: Указывает, что этот файл находится в стандартной папке контроллеров
//подключаем класс Form Request, позволяет вынести правила валидации из контроллера в отдельный класс(не перегружать  лишним кодом)
use App\Http\Requests\RegisterRequest;
use App\Models\User;//Подключаем модель User, чтобы иметь возможность создавать новые записи в таблице пользователей

class RegisterController extends Controller//отображения формы
{//вызывается при GET-запросе на маршрут /register
//Возвращает представление (Blade-шаблон)
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)//обработки регистрации
    //Если данные не проходят валидацию , Laravel сам остановит выполнение и вернет пользователя назад с ошибками
{
    User::create([//Массовое создание записи
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Hash::make($request->password), // шифруем пароль!
    ]);

    return redirect()->route('loginForm')->with('success', 'Регистрация успешна! Войдите в систему.');
    //После успешного сохранения в БД мы перенаправляем пользователя на маршрут с именем loginForm
}
}