<x-layouts.main>
    <x-slot:title>
        Модерация
    </x-slot>

    <div class="container" style="text-align: center;">
        <h1>Все пользователи</h1>
    </div>


    <table class="table col-md-15 mt-3 table-hover table-borderless table-striped">
        <tr>
            <th class="col-2">Имя</th>
            <th class="col-2">Email</th>
            <th class="col-1">Текущая роль</th>
            <th class="col-1">Изменить роль</th>
            <th class="col-1">Текущий статус</th>
            <th class="col-1">Изменить статус</th>
        </tr>
        @foreach($users as $user)
            @php
                $banStatus = 'нет бана';
                $changeStatus = 'дать бан';
                //0 - нет бана, 1 - есть бан
                if ($user->ban_status) {
                    $banStatus = 'бан';
                    $changeStatus = 'снять бан';
                }

                $changeRole = 'сделать пользователем';
                 if ($user->role->name == 'user') {
                    $changeRole = 'сделать модератором';
                }
            @endphp
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td><a href="{{ route('moderator.changeRole', ['id' => $user->id]) }}">{{ $changeRole }}</a></td>
                <td>{{ $banStatus }}</td>
                <td><a href="{{ route('moderator.changeBanStatus', ['id' => $user->id]) }}">{{ $changeStatus }}</a></td>
            </tr>
        @endforeach
    </table>

    <div class="col-md-6 offset-md-3">
        {{ $users->links() }}
    </div>

</x-layouts.main>
