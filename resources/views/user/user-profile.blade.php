<x-layouts.main>
    <x-slot:title>
        Профиль
    </x-slot>

    <div class="container" style="text-align: center;">
        <h5>Профиль пользователя</h5>
    </div>

    @php
        $banStatus = 'нет бана';
        if ($user->ban_status) {
            $banStatus = 'бан';
        }
        switch ($user->role_id) {
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
    <div class="col-md-6 offset-md-3">
        <div>Имя: {{ $user->name }}</div>
        <div>Количество сообщений: {{ $user->posts->count('id') }}</div>
        <div>Статус бана: {{ $banStatus }}</div>
        <div>Роль: {{ $role }}</div>
    </div>

</x-layouts.main>
