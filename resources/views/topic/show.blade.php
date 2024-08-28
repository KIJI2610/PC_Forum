<x-layouts.main>
    <x-slot:title>
        {{$section->name}}
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/show_topic.css') }}">
    <div class="container" style="text-align: center;">
        <h1>Раздел {{$section->name}}</h1>
    </div>

    <table class="table col-md-15 mt-3">
        <tr class="table-dark">
            <th class="col-3">Тема</th>
            <th class="col-2">Автор</th>
            <th class="col-2">Сообщ в теме</th>
            <th class="col-2">Последний ответ</th>
        </tr>
        @foreach($topics as $topic)
            <tr>
                <td>
                    <div class="mb-1 ">
                        <h5><a class="link-dark"
                               href="{{ route('posts', ['topicId' => $topic->id]) }}">{{ $topic->name }}</a></h5>
                    </div>
                    <div>
                        @auth()
                            @can('userIsNotBanned')
                                @if(auth()->user()->id == $topic->user_id or auth()->user()->role->name == 'moderator')
                                    <span class="redact-btn">
                                        <a class="redact-link" href="{{ route('topic.edit', ['topicId' => $topic->id]) }}">Редактировать</a>
                                    </span>
                                    <span class="delete-btn">
                                        <a class="delete-link" href="{{ route('topic.soft-del', ['topicId' => $topic->id]) }}">Удалить</a>
                                    </span>
                                @endif
                            @endcan
                        @endauth
                    </div>
                </td>
                <td><a class="link-dark" href="{{ route('user.profile', ['userId' => $topic->user->id]) }}">{{ $topic->user->name }}</a></td>
                <td>{{ $topic->posts()->count('id') }}</td>
                <td>
                    {{--если в массиве (в теме) есть сообщения--}}
                    @if(count($topic->posts()->latest()->take(1)->get('created_at')->all()))
                        {{ $topic->posts()->orderByDesc('created_at')->first()->updated_at->format('d.m.Y')}}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>


    @auth()
        @can('userIsNotBanned')
            <div class="container text-center" >
                <h6>
                    <a class="btn btn-outline-dark" href="{{ route('topic.create', ['sectionId' => $section->id]) }}"
                       role="button">Создать новую тему в разделе {{$section->name}}</a>

                </h6>
            </div>
        @endcan
    @endauth
    <div class="col-md-6 offset-md-3">
        {{ $topics->links() }}
    </div>

</x-layouts.main>
