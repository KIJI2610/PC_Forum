<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

{{--    <link rel="stylesheet" href={{ asset('css/style.css')}}>--}}
{{--    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>--}}
</head>
<body style="background-color: #b6d1d9;">
<nav class="sticky-top navbar navbar-expand-lg bg-dark" id="header" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Главная</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 header-text">
                {{--если пользователь аутентифицирован, покажем эти роуты--}}
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('my.profile') }}">Мой профиль</a>
                    </li>

                    {{--если пользователь имеет роль moderator, отработает шлюз и покажем ссылку на админ панель--}}
                    @can('moderator')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('moderator.showUsers') }}">Модерация</a>
                        </li>
                    @endcan
                @endif
            </ul>
            <ul class="navbar-nav {{ auth()->check() ? 'ms-auto' : '' }} mb-2 mb-lg-0 header-text">
                @auth
                    <li class="nav-item exit-item">
                        <a class="nav-link" id="exit" href="{{ route('logout') }}" onclick="">Выйти из аккаунта</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Войти</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.register') }}">Регистрация</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<main class="main mt-3">
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        @if(session('msg'))
            <div class="alert alert-warning">
                {{ session('msg') }}
            </div>
        @endif

        {{ $slot }}
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer style="background-color: #212429;" class="fixed-bottom">
    <div class="mt-3 text-center text-secondary">Разработано
    back: <a href="https://t.me/OlegTatarenko" class="mt-3 text-center link-secondary">@OlegTatarenko</a>
    front: <a href="https://t.me/Kirrinayaara" class="mt-3 text-center link-secondary">@Kirrinayaara</a>
    </div>
</footer>
</html>
