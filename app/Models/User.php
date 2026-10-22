<?php //Модель — это класс, который представляет таблицу в базе данных.
namespace App\Models;//файл находится в папке app/Models
use Illuminate\Database\Eloquent\Factories\HasFactory;//подключает готовые классы Laravel, которые мы будем использовать
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable//создаём класс с именем User,наследуемся от встроенного класса Laravel для авторизации
{
    use HasApiTokens, HasFactory, Notifiable;//подключаем traits (готовые наборы функций)
    //HasApiTokens — для работы с API-токенами
    //HasFactory — для создания тестовых данных 
    //Notifiable — для отправки уведомлений (email, SMS)
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [//массив
    'login',
    'email',
    'full_name',
    'phone',
    'password',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [//массив  скрытые поля
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [//массив приведение типов
        'email_verified_at' => 'datetime',//поле будет автоматически конвертироваться в объект Carbon
        'password' => 'hashed',//Когда мы сохраняем пароль, Laravel автоматически хеширует его через Hash::make()
    ];
}
