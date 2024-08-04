<x-layouts.main>
    <x-slot:title>
        Логин
    </x-slot>

    <div class="container" style="text-align: center;">
        <h2>Войдите в свой аккаунт</h2>
    </div>

   <div class="col-md-6 offset-md-3">
       <form action="{{ route('login.auth') }}" method="post">
           @csrf
           <div class="mb-3">
               <label for="email" class="form-label">Email</label>
               <input
                   name="email"
                   type="email"
                   class="form-control"
                   id="email"
                   placeholder="Email">
           </div>
           <div class="mb-3">
               <label for="password" class="form-label">Пароль</label>
               <input name="password"
                      type="password"
                      class="form-control"
                      id="password"
                      placeholder="Пароль">
           </div>
           <div class="mb-3 form-check">
               <input name="remember" class="form-check-input" type="checkbox" id="remember">
               <label class="form-check-label" for="remember">
                   Запоминть меня
               </label>
           </div>
           <button type="submit" class="btn btn-primary">Войти</button>
       </form>
   </div>

</x-layouts.main>
