<?php
//Подключение нужных классов
use Illuminate\Database\Migrations\Migration;//базовый класс, от которого наследуются все миграции. Даёт методы up() и down()
use Illuminate\Database\Schema\Blueprint;//класс для описания структуры таблицы (какие поля, какие типы)
use Illuminate\Support\Facades\Schema;//фасад Laravel для работы со схемой базы данных (создание/изменение таблиц)

return new class extends Migration//Создаётся анонимный класс, который наследуется от Migration
{
    public function up(): void//Метод up() — что сделать при применении миграции
    {
        Schema::table('users', function (Blueprint $table) {//"хотим изменить существующую таблицу users"
            $table->string('password')->nullable()->after('login');//добавляем новое поле password типа VARCHAR (строка),
            //->nullable() — поле может быть пустым ,
            // //поле добавится после поля login в таблице
            //в результате  в таблице users появляется новое поле password
        });
    }

    public function down(): void//Метод down() — как откатить миграцию
    {
        Schema::table('users', function (Blueprint $table) {////"хотим изменить существующую таблицу users"
            $table->dropColumn('password');//dropColumn('password') — удаляет поле password из таблицы
        });
    }
};