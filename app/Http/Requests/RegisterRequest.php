<?php // задача — валидация данных до того,как они попадут в контроллер. 
// Это позволяет оставить контроллер чистым и не перегружать его лишним кодом проверок

namespace App\Http\Requests;//Указывает, что файл находится в стандартной папке Laravel для запросов

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest//класс наследуется от встроенного класса Laravel FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool//Авторизация запроса
    //метод проверяет, имеет ли пользователь право совершать это действие
{
    return true;//По умолчанию Laravel создает этот метод с возвратом false, поэтому используем true
}

public function rules(): array//Правила валидации
{
    return [
        'login' => ['required', 'min:6', 'alpha_num'],
        'password' => ['required', 'min:8'],
        'email' => ['nullable'],
        'full_name' => ['nullable'],
        'phone' => ['nullable'],
    ];
}
}
