<x-layouts.main>
    <x-slot:title>
        Форум по электронике
    </x-slot>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <section class="text-center home-main-label">
        <h1>Форум по электронике</h1>
    </section>

            <table class="table col-md-15 mt-3">
                <tr class="table-dark">
                    <th class="col-2">Раздел</th>
                    <th class="col-1">Тем</th>
                    <th class="col-1">Сообщений</th>
                    <th class="col-2">Последний ответ</th>
                </tr>
                @foreach($sections as $section)
                    <tr>
                        <td><h5><a class="link-dark" href="{{ route('topics', ['sectionId' => $section->id]) }}">{{$section->name}}</a></h5></td>
                        <td>{{$section->topics()->count()}}</td>
                        @php
                            $topics = $section->topics;
                            $count = 0;
                                foreach ($topics as $topic){
                                    $count += $topic->posts()->count();
                                }
                        @endphp
                        <td> {{ $count }}</td>
                        <td>Последний ответ</td>
                    </tr>
                @endforeach
            </table>



</x-layouts.main>


{{--<div class="card" style="width: 18rem;">--}}
{{--    <div class="card-header">--}}
{{--        <h1>Форум по электронике</h1>--}}
{{--    </div>--}}
{{--    <ul class="list-group list-group-flush">--}}
{{--        @foreach($sections as $section)--}}
{{--            <li class="list-group-item">--}}
{{--                <h5><a href="{{ route('topics', ['sectionId' => $section->id]) }}">{{$section->name}}</a></h5>--}}
{{--                Тем: {{$section->topics()->count()}}--}}
{{--                @php--}}
{{--                    $topics = $section->topics;--}}
{{--                    $count = 0;--}}
{{--                        foreach ($topics as $topic){--}}
{{--                            $count += $topic->posts()->count();--}}
{{--                        }--}}
{{--                @endphp--}}
{{--                <div>Сообщений: {{ $count }}</div>--}}
{{--            </li>--}}
{{--        @endforeach--}}
{{--    </ul>--}}
{{--</div>--}}
