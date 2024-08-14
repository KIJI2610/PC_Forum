<x-layouts.main>
    <x-slot:title>
        {{$topic->name}}
    </x-slot>

    <div class="container" style="text-align: center;">
        <h1>Обсуждение в теме {{$topic->name}}</h1>
        <a class="link" href="{{ route('topics', ['sectionId' => $topic->section_id]) }}">
            вернуться в темы
        </a>
    </div>

    <table class="table table-bordered col-md-15 mt-3">
        @foreach($posts as $post)
            <tr>
                <td class="col-2 align-bottom">
                    <a class="link-dark" href="{{ route('user.profile', ['userId' => $post->user_id]) }}">{{ $post->user->name }}</a>
                </td>
                <td>
                    <div>
                        @auth()
                            @can('userIsNotBanned')
                                @if(auth()->user()->id == $post->user_id or auth()->user()->role->name == 'moderator')
                                    <span class="badge rounded-pill bg-success">
                                        <a class="text-light" href="{{ route('post.edit', ['postId' => $post->id]) }}">Редактировать</a>
                                    </span>
                                    <span class="badge rounded-pill bg-danger">
                                        <a class="text-light" href="{{ route('post.soft-del', ['postId' => $post->id]) }}">Удалить</a>
                                    </span>
                                @endif
                            @endcan
                        @endauth
                    </div>
                    <div class="text-end fw-light">{{ $post->created_at }}</div>
                    <div class="col-10 fs-5">{{ $post->content }}</div>

                </td>
            </tr>
        @endforeach
    </table>

    @auth()
        @can('userIsNotBanned')
            <div class="container" style="text-align: center;">
                <h6>
                    <a href="{{ route('post.create', ['topicId' => $topic->id]) }}">
                        новое сообщение
                    </a>
                </h6>
            </div>
        @endcan
    @endauth
    <div class="col-md-6 offset-md-3">
        {{ $posts->links() }}
    </div>

</x-layouts.main>
