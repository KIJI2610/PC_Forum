<x-layouts.main>
    <x-slot:title>
        {{$topic->name}}
    </x-slot>

    <div class="container" style="text-align: center;">
        <h5>{{$topic->name}}</h5>
        <a class="link" href="{{ route('topics', ['sectionId' => $topic->section_id]) }}">
            вернуться в темы
        </a>
    </div>

    @foreach($posts as $post)
        <div class="card mx-auto" style="width: 60rem;">
            <div class="card-body">
                {{ $post->content }}
                <div>
                    <h8 class="card-subtitle text-body-secondary">
                        Автор:
                        <a class="link" href="{{ route('user.profile', ['userId' => $post->user_id]) }}">
                            {{ $post->user->name }}
                        </a>
                    </h8>
                </div>
                <div>
                    <h8 class="card-subtitle text-body-secondary">Создано: {{ $post->created_at }}</h8>
                </div>
                @auth()
                    @can('userIsNotBanned')
                        @if(auth()->user()->id == $post->user_id or auth()->user()->role->name == 'moderator')
                            <div>
                                <h8 class="card-subtitle text-body-secondary">
                                    -<a href="{{ route('post.edit', ['postId' => $post->id]) }}">
                                        редактировать
                                    </a>
                                </h8>
                                -
                                <h8 class="card-subtitle text-body-secondary">
                                    <a href="{{ route('post.soft-del', ['postId' => $post->id]) }}">
                                        удалить
                                    </a>-
                                </h8>
                            </div>
                        @endif
                    @endcan
                @endauth
            </div>
        </div>
    @endforeach
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
