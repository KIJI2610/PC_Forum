<x-layouts.main>
    <x-slot:title>
        Регистрация
    </x-slot>

    <div class="container" style="text-align: center;">
        <h2>Регистрация</h2>
    </div>

        <div class="col-md-6 offset-md-3">
            <form action="{{ route('user.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input
                        name="name"
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        placeholder="Имя"
                        value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        name="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        placeholder="Email"
                        value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input name="password"
                           type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           placeholder="Пароль">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
                    <input name="password_confirmation"
                           type="password"
                           class="form-control"
                           id="password_confirmation"
                           placeholder="Подтвердите пароль">
                </div>
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                <a href="{{route('login')}}" class="ms-3">Уже зарегистрированы?</a>
            </form>
        </div>

</x-layouts.main>
