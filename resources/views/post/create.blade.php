<x-layouts.main>
    <x-slot:title>
        Новое сообщение
    </x-slot>

    <div class="container" style="text-align: center;">
        <h1>Создайте новое сообщение для темы {{ $topic->name }}</h1>
    </div>

   <div class="col-md-6 offset-md-3">
       <form action="{{ route('post.store', ['topicId' => $topic->id]) }}" method="post">
           @csrf
           <div class="mb-3">
               <textarea
                   name="post_content"
                   placeholder="Текст вашего сообщения"
                   class="form-control @error('post_content') is-invalid @enderror"
                   id="post_content"
                ></textarea>
               @error('post_content')
               <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>
           <button type="submit" class="btn btn-primary">Сохранить</button>
       </form>
   </div>

</x-layouts.main>
