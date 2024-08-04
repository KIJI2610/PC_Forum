<x-layouts.main>
    <x-slot:title>
        Редактировать сообщение
    </x-slot>

    <div class="container" style="text-align: center;">
        <h5>Отредактируйте свое сообщение в теме {{ $post->topic->name }}</h5>
    </div>

   <div class="col-md-6 offset-md-3">
       <form action="{{ route('post.store-edit', ['postId' => $post->id]) }}" method="post">
           @csrf
           <div class="mb-3">
               <label for="post_content" class="form-label">Последнее изменение: {{ $post->updated_at }}</label>
               <textarea
                   name="post_content"
                   class="form-control @error('post_content') is-invalid @enderror"
                   id="post_content"
                >{{ $post->content }}</textarea>
               @error('post_content')
               <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>
           <button type="submit" class="btn btn-primary">Сохранить</button>
       </form>
   </div>

</x-layouts.main>
