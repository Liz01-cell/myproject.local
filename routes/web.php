<?php //файл  отвечает за маршрутизацию обычных веб-страниц. 
// Его задача — связать URL-адрес (то, что пользователь вводит в браузере) с конкретным контроллером или Blade-шаблоном, 
// а также применить к ним правила безопасности (middleware)

//подключаем контроллеры, чтобы Laravel знал, к какому классу обращаться при обработке форм регистрации и входа
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;//подключаем Route, чтобы использовать его методы (get, post, middleware)

// Главная страница
Route::get('/', function () {//Означает, что маршрут отвечает на HTTP-метод GET
    return view('home');//используются замыкания (анонимные функции), которые просто возвращают Blade-шаблон 
})->name('home');//Задает уникальное имя маршруту, позволяет удобно ссылаться на него в Blade через {{ route('home') }},
// даже если URL в будущем изменится

// Страница "О нас"
Route::get('/about', function () {
    return view('about');
})->name('about');

// Регистрация
//GET: Показывает форму регистрации (вызывает метод showRegistrationForm)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('registerForm');
//POST: Обрабатывает отправку этой формы (вызывает метод register, который проверяет валидацию и сохраняет пользователя в БД)
Route::post('/register', [RegisterController::class, 'register'])->name('register');

//  ИСПРАВЛЕНИЕ: добавлен маршрут loginForm 
//Аналогично регистрации: GET показывает форму входа, а POST отправляет данные в AdminController для проверки логина и пароля
Route::get('/login', function () {
    return view('login');
})->name('loginForm');
//использует метод POST (а не GET), так как выход из системы изменяет состояние сессии на сервере. Это правило безопасности Laravel
Route::post('/login', [AdminController::class, 'login'])->name('login.process');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// ЗАДАНИЕ 1: Защищённые страницы (middleware auth)
//Route::middleware(['auth'])->group(...): Это группировка маршрутов, встроенный посредник auth проверяет, вошел ли посетитель в систему
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

});

// ЗАДАНИЕ 2: Админ-панель (middleware admin)
//отоброжение входа
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');
//обработка входа
Route::post('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login.process');

//применяем наш собственный посредник AdminMiddleware (который мы зарегистрировали в Kernel.php)
Route::middleware(['admin'])->group(function () {
//проверяет, есть ли в сессии данные Admin26 и Demo20. нет — перенаправляет на /admin/login, 
// да — пропускает к методу panel контроллера, который отрисовывает защищенную админ-панель
    Route::get('/admin/panel', [AdminController::class, 'panel'])->name('admin.panel');
    Route::post('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
});