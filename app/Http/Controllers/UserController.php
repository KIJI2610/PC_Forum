<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        //массово записываем валидные данные пользователя в базу, записываемые поля указаны в модели User в свойстве $fillable
        //при записи в базу пароль хешируется, это прописано в методе cast модели User
        $user = User::create($request->all());
        //сразу же аутентифицируем юзера, чтобы ему не вводить данные в форму login
        Auth::login($user);
        return redirect()->route('home')->with('success', 'Вы успешно зарегистрированы!');
    }

    public function login()
    {
        return view('user.login');
    }

    public function loginAuth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //Если аутентификация пройдена, то делаем редирект, записываем флеш-сообщение
        //вторым параметром передаем значение чек-бокса remember, чтобы запомнить пользователя после логина
        if (Auth::attempt($credentials, $request->boolean('remember'))){
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Привет, ' . Auth::user()->name . '!');
        }
        return back()->withErrors([
            'email' => 'Неверный пароль или email',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Вы вышли из аккаунта!');
    }

    public function myProfile()
    {
        return view('user.my-profile');
    }

    public function userProfile($userId)
    {
        return view('user.user-profile', [
            'user' => User::find($userId)
        ]);
    }
}
