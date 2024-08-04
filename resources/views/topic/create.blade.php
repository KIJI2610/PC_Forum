<x-layouts.main>
    <x-slot:title>
        Новая
    </x-slot>

    <div class="container" style="text-align: center;">
        <h5>Укажите название новой темы для раздела {{$section->name}}</h5>
    </div>

   <div class="col-md-6 offset-md-3">
       <form action="{{ route('topic.store', ['sectionId' => $section->id]) }}" method="post">
           @csrf
           <div class="mb-3">
               <label for="topic_name" class="form-label">Тема</label>
               <input name="topic_name"
                      type="text"
                      class="form-control @error('topic_name') is-invalid @enderror"
                      id="topic_name"
                      placeholder="Ваша новая тема">
               @error('topic_name')
               <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>
           <div class="mb-3">
               <label for="post_content" class="form-label">Пост</label>
               <textarea
                   name="post_content"
                   placeholder="Текст вашего поста"
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
