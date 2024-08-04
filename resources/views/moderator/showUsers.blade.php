<x-layouts.main>
    <x-slot:title>
        Модерация
    </x-slot>

    <div class="container" style="text-align: center;">
        <h5>Все пользователи</h5>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <table class="table col-md-15">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Статус бана</th>
                </tr>
                @foreach($users as $user)
                    @php
                        $banStatus = 'нет бана';
                        //0 - нет бана, 1 - есть бан
                        if ($user->ban_status) {
                            $banStatus = 'бан';
                        }
                    @endphp
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('moderator.changeRole', ['id' => $user->id]) }}">{{ $user->role->name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('moderator.changeBanStatus', ['id' => $user->id]) }}">{{ $banStatus }}</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="col-md-6 offset-md-3">
        {{ $users->links() }}
    </div>

</x-layouts.main>
