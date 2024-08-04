<x-layouts.main>
    <x-slot:title>
        Редактировать тему
    </x-slot>

    <div class="container" style="text-align: center;">
        <h5>Отредактируйте название своей темы из раздела {{ $topic->section->name }}</h5>
    </div>

   <div class="col-md-6 offset-md-3">
       <form action="{{ route('topic.store-edit', ['topicId' => $topic->id]) }}" method="post">
           @csrf
           <div class="mb-3">
               <label for="topic_name" class="form-label">Последнее изменение: {{ $topic->updated_at }}</label>
               <textarea
                   name="topic_name"
                   class="form-control @error('topic_content') is-invalid @enderror"
                   id="topic_name"
                >{{ $topic->name }}</textarea>
               @error('topic_name')
               <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>
           <button type="submit" class="btn btn-primary">Сохранить</button>
       </form>
   </div>

</x-layouts.main>
