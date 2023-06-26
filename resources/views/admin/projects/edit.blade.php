@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="my-3">Modifica | {{ $project->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @method('PUT')
            <div class="mb-4">
                <label for="title" class="form-label">Titolo (*)</label>
                <input
                  id="title"
                  value="{{ old('title', $project->title) }}"
                  class="form-control @error('title') is-invalid @enderror"
                  name="title"
                  placeholder="Titolo progetto"
                  type="text"
                >
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Descrizione (*)</label>
                <textarea class="form-control"  name="description" id="description" cols="30" rows="10" placeholder="Descrivi il progetto">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="form-label">Immagine (*) <br> Inserisci come nell'esempio le skills utilizzate nel progetto, scritte in piccolo e separate da virgola</label>
                <input
                  id="image"
                  value="{{ old('image', $project->image) }}"
                  class="form-control @error('image') is-invalid @enderror"
                  name="image"
                  placeholder="github,laravel,vue,bootstrap"
                  type="text"
                >
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
              <label for="type_id" class="form-label">Tipo di Sviluppo</label>
              <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                <option value="">Selezionare una tipologia di sviluppo</option>
                @foreach ($types as $type)
                  <option value="{{ $type->id }}" @if($type->id == old('type_id', $project->type?->id)) selected @endif>{{$type->name}}</option>
                  @endforeach
              </select>
              @error('type_id')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>

            <label class="form-label">Tecnologia di sviluppo</label>
              <div class="mb-4 d-flex">
              <div class="btn-group flex-wrap" role="group" aria-label="Basic checkbox toggle button group">
                @foreach ( $tecnologies as $tecnology )
                <input
                  type="checkbox"
                  class="btn-check"
                  id="tecnology{{ $loop->iteration }}"
                  autocomplete="off"
                  value="{{ $tecnology->id }}"
                  name="tecnologies[]"
                  @if(!$errors->any() && $project?->tecnologies->contains($tecnology))
                  checked

                  @elseif($errors->any() && in_array($tecnology->id,
                  old('tecnologies',[])))
                  checked

                  @endif
                  >
                <label class="btn btn-outline-primary rounded-3 me-1 mt-1" for="tecnology{{ $loop->iteration }}">{{ $tecnology->name }}</label>

                @endforeach

              </div>
              @error('technologies')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="mb-4">
              <label for="thumb" class="form-label">Immagine Progetto</label>
              <input
                id="thumb"
                onchange="showImage(event)"
                class="form-control"
                name="thumb"
                type="file"
              >
              <img class="mt-3 rounded-2" style="width: 200px" id="prev-image" src="{{ asset('storage/' . $project->image_path) }}" onerror="this.src='/img/no_image.jpg'">
          </div>

            <div class="mb-4">
                <label for="date" class="form-label">Data inizio Sviluppo</label>
                <input
                  id="date"
                  value="{{ old('date', $project->date) }}"
                  class="form-control @error('date') is-invalid @enderror"
                  name="date"
                  placeholder="yyyy-mm-dd"
                  type="text"
                >
                @error('date')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

                <button type="submit" class="btn btn-success">Salva</button>
                <button type="reset" class="btn btn-danger">Cancella</button>
            </form>

        </div>
    </main>

    {{-- Script CK editor 5 --}}
    <script>
      ClassicEditor
          .create( document.querySelector( '#description' ) )
          .catch( error => {
              console.error( error );
          } );

      function showImage(event){
      const tagImage = document.getElementById('prev-image');
      tagImage.src = URL.createObjectURL(event.target.files[0]);
      }
    </script>

@endsection
