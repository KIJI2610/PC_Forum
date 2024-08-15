<x-layouts.main>
    <x-slot:title>
        Регистрация
    </x-slot>
    <link rel="stylesheet" href="{{ asset('css/reg.css') }}">
        <div class="col-md-6 offset-md-3 window-aut">
            <div class="container" style="text-align: center;">
                <h1 class="label-login-title">Регистрация</h1>
            </div>
            <form action="{{ route('user.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    
                    <input
                        name="name"
                        type="text"
                        class="form-control-0 @error('name') is-invalid @enderror form-control-0"
                        id="name"
                        oninput="focusInput('name', 'label-name')"
                        onclick="clickDefaultTextLabel('label-name')"
                        value="{{ old('name') }}">
                        <label for="name" class="form-label-0" id="label-name" data="Имя">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @else
                                Имя
                            @endif
                        </label>
                </div>
                <div class="mb-3">
                    <input
                        name="email"
                        type="email"
                        class="form-control-0 @error('email') is-invalid @enderror"
                        id="email"
                        oninput="focusInput('email', 'label-email')"
                        onclick="clickDefaultTextLabel('label-email')"
                        value="{{ old('email') }}">
                    <!-- <label for="email" class="form-label-0" id="label-email">Email</label>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror -->
                    <label for="email" class="form-label-0" id="label-email" data="Email">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @else
                                Email
                            @endif
                    </label>
                </div>
                <div class="mb-3">
                    <input name="password"
                           type="password"
                           class="form-control-0 @error('password') is-invalid @enderror"
                           oninput="focusInput('password', 'label-password')"
                           onclick="clickDefaultTextLabel('label-password')"
                           id="password">
                    <!-- <label for="password" class="form-label-0" id="label-password">Пароль</label>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror -->
                    <label for="password" class="form-label-0" id="label-password" data="Пароль">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @else
                                Пароль
                            @endif
                    </label>
                </div>
                <div class="mb-3">
                    
                    <input name="password_confirmation"
                           type="password"
                           class="form-control-0"
                           oninput="focusInput('password_confirmation', 'label-password_confirmation')"
                           id="password_confirmation">
                    <label for="password_confirmation" class="form-label-0" id="label-password_confirmation">Подтвердите пароль</label>
                </div>
                <div class="btn-container-login">
                    <button type="submit" class="login-btn btn btn-primary">Зарегистрироваться</button>
                    <button class="login-btn btn btn-primary reg-btn"><a href="{{route('login')}}" class="link-reg">Есть аккаунт ?</a></button>
                </div>

            </form>
        </div>
        <script src="{{ asset('js/reg.js') }}"></script>
</x-layouts.main>
