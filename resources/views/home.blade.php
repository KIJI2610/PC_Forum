<x-layouts.main>
    <x-slot:title>
        Главная
    </x-slot>

    <div class="card" style="width: 18rem;">
        <div class="card-header">
            <h5>Разделы форума</h5>
        </div>
        <ul class="list-group list-group-flush">
            @foreach($sections as $section)
                <li class="list-group-item">
                    <h5><a href="{{ route('topics', ['sectionId' => $section->id]) }}">{{$section->name}}</a></h5>
                    Тем: {{$section->topics()->count()}}
                    @php
                        $topics = $section->topics;
                        $count = 0;
                            foreach ($topics as $topic){
                                $count += $topic->posts()->count();
                            }
                    @endphp
                    <div>Сообщений: {{ $count }}</div>
                </li>
            @endforeach
        </ul>
    </div>

</x-layouts.main>
