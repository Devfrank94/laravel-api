@extends('layouts.app')

@section('content')
  <div class="container mt-5 ms-3">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>

    <div class="row justify-content-center">
      <div class="col">
        <div class="card mb-4">
          <div class="card-header">Ciao {{ Auth::user()->name }}</div>

          <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <h4 class="mb-3">Benvenuto nella tua Dashboard</h4>
            <p>Progetti in portfolio: {{ $num_projects }}</p>
            <h4 class="mt-4 mb-3">Ultimo Progetto

                <a href="{{route('admin.projects.show', $last_project)}}" class="btn btn-secondary"><i class="fa-regular fa-eye" title="Vedi" style="color: #ffffff;"></i></a>

                <a href="{{route('admin.projects.edit', $last_project)}}" class="btn btn-primary"><i class="fa-regular fa-pen-to-square" title="Modifica" style="color: #ffffff;"></i></a>

            </h4>

            <div>
              <div class="card-wrapper w-75 d-flex flex-column">

                <img class="w-50 mb-4 rounded-3" id="prev-image" src="{{ asset('storage/' . $last_project->image_path) }}" onerror="this.src='/img/no_image.jpg'" alt="{{ $last_project->title }}">

                <div class="card w-50 my-3">
                  <h5><div class="fw-bold text-center mt-3">Skills utilizzate:</div></h5>
                  <img class="rounded w-50 my-3 mx-auto" src="https://skillicons.dev/icons?i={{ $last_project->image }}" alt="{{$last_project->title}}" title="{{$last_project->title}}">
                  <div class="card-body">
                  <h5><div class="fw-bold">Nome Progetto:</div> {{$last_project->title}}</h5>
                    <p><div class="fw-bold">Descrizione:</div> {!!$last_project->description!!}</p>
                    <p><div class="fw-bold">Tipologia di Sviluppo:</div><span class="badge text-bg-primary">{{ $last_project->type->name}}</span></p>
                    <p>
                      <div>
                        <h6 class="fw-bold">Tecnologia utilizzata:</h6>
                        @forelse ( $last_project->tecnologies as $tecnology )
                        <span class="badge text-bg-warning">{{ $tecnology->name }}</span>
                        @empty
                        <span class="badge text-bg-warning"> - N/D - </span>
                        @endforelse

                      </div>
                    </p>
                    <span><div class="fw-bold">Data di inizio sviluppo:</div> {{ $last_project->date }}</span>
                  </div>
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
