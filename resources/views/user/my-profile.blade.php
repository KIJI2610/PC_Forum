<x-layouts.main>
    <x-slot:title>
        Профиль
    </x-slot>
    <link rel="stylesheet" href="{{ asset('css/user_profile.css') }}">
    <div class="container mb-3" style="text-align: center;">
        <h1>Ваш профиль</h1>
    </div>
    @php
        $banStatus = 'нет бана';
        if (Illuminate\Support\Facades\Auth::user()->ban_status) {
            $banStatus = 'бан';
        }
        switch (Illuminate\Support\Facades\Auth::user()->role_id) {
            case 1:
                $role = 'user';
                break;
            case 2:
                $role = 'moderator';
                break;
            case 3:
                $role = 'admin';
                break;
        }
    @endphp
    <div class="col-md-6 offset-md-3 p-4 user-profile">
        <p>Имя: {{ Auth::user()->name }}</p>
        <p>Количество сообщений: {{ Auth::user()->posts->count('id') }}</p>
        <p>Статус бана: {{ $banStatus }}</p>
        <p>Роль: {{ $role }}</p>
    </div>
</x-layouts.main>
