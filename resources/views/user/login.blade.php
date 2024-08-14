<x-layouts.main>
    <x-slot:title>
        Логин
    </x-slot>

    

   <div class="col-md-6 offset-md-3 window-aut">
        <div class="container" style="text-align: center;">
             <h1 class="label-login-title">Войдите в свой аккаунт</h1>
        </div>
       <form action="{{ route('login.auth') }}" method="post">
           @csrf
           <div class="mb-3">
               <input
                   name="email"
                   type="email"
                   class="form-control-0"
                   oninput="focusInput('email', 'label-email')"
                   id="email">
                   
                <label for="email" class="form-label-0" id="label-email">Email</label>
           </div>
           <div class="mb-3">
               
               <input name="password"
                      type="password"
                      class="form-control-0"
                      oninput="focusInput('password', 'label-password')"
                      id="password">
                <label for="password" class="form-label-0" id="label-password">Пароль</label>
           </div>
           <div class="mb-3 form-check">
               <input name="remember" class="form-check-input" type="checkbox" id="remember">
               <label class="form-check-label" for="remember">
                   Запоминть меня
               </label>
           </div>
           <div class="btn-container-login">
                <button type="submit" class="login-btn btn btn-primary">Войти</button>
           </div>

       </form>
   </div>
   <script src="{{ asset('js/aut.js') }}"></script>

</x-layouts.main>
