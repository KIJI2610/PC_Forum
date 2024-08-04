<x-layouts.main>
    <x-slot:title>
        {{$section->name}}
    </x-slot>

    <div class="container" style="text-align: center;">
        <h5>{{$section->name}}</h5>
    </div>

    @foreach($topics as $topic)
        <div class="card mx-auto" style="width: 60rem;">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('posts', ['topicId' => $topic->id]) }}">
                        {{ $topic->name }}
                    </a>
                </h5>
                <div>
                    <h8 class="card-subtitle text-body-secondary">
                        Сообщений в теме: {{ $topic->posts()->count('id') }}
                    </h8>
                </div>
                <h8 class="card-subtitle text-body-secondary">
                    {{--если в массиве (в теме) есть сообщения--}}
                    @if(count($topic->posts()->latest()->take(1)->get('created_at')->all()))
                        Последнее сообщение: {{ $topic->posts()->orderByDesc('created_at')->first()->updated_at}}
                    @endif
                </h8>
                @auth()
                    @can('userIsNotBanned')
                        @if(auth()->user()->id == $topic->user_id or auth()->user()->role->name == 'moderator')
                            <div>
                                <h8 class="card-subtitle text-body-secondary">
                                    -<a href="{{ route('topic.edit', ['topicId' => $topic->id]) }}">
                                        редактировать
                                    </a>
                                </h8>
                                -
                                <h8 class="card-subtitle text-body-secondary">
                                    <a href="{{ route('topic.soft-del', ['topicId' => $topic->id]) }}">
                                        удалить (включая все сообщения из темы)
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
                    <a href="{{ route('topic.create', ['sectionId' => $section->id]) }}">
                        Создать новую тему в разделе {{$section->name}}
                    </a>
                </h6>
            </div>
        @endcan
    @endauth
    <div class="col-md-6 offset-md-3">
        {{ $topics->links() }}
    </div>

</x-layouts.main>
