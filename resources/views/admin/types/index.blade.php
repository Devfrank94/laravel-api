@extends('layouts.app')

@section('content')
<main>
<div class="container my-4">
    <h1 class="mb-4">Elenco Tipi di sviluppo</h1>

    {{-- <a href="{{route('admin.types.create')}}" class="btn btn-success mb-3"><i class="fa-solid fa-file-circle-plus"></i> Nuovo tipo di sviluppo</a> --}}
        @if (session('deleted'))
            <div class="alert alert-success" role="alert">
                {{ session('deleted') }}
            </div>
        @endif
    <div class="border border-1 mb-3">
    <table class="table table-hover mb-0">
        <thead class="text-center">
            <tr>
                <th scope="col">Tipo Sviluppo</th>
                <th scope="col">Num Progetti Associati</th>
                {{-- <th scope="col">Azioni</th> --}}
            </tr>
        </thead>
            <tbody class="text-center">
                @foreach ($types as $type)
                    <tr class="vertical-align-middle">
                        <th scope="row">{{$type->name}}</th>
                        <td><span class="badge text-bg-primary">{{ count($type->projects)}}</span></td>
                        {{-- <td>
                          <a href="{{route('admin.types.show', $type)}}" class="btn btn-secondary"><i class="fa-regular fa-eye" title="Vedi" style="color: #ffffff;"></i></a>
                        </td> --}}
                        {{-- <td>
                          <a href="{{route('admin.types.edit', $type)}}" class="btn btn-primary"><i class="fa-regular fa-pen-to-square" title="Modifica" style="color: #ffffff;"></i></a>
                        </td>
                        <td>
                            @include('admin.partials.form-delete')
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
    </table>
  </div>
</div>
</main>

@endsection
