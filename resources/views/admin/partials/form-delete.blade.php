
{{-- <form action="{{route('admin.projects.destroy', $project)}}" onsubmit="return confirm('Confermi l\'eliminazione di {{ $project->title }} ?')" method="POST" class="d-inline">

  @csrf
  @method('DELETE')

  <button type="submit" class="btn btn-danger d-inline"><i class="fa-regular fa-trash-can" title="Elimina" style="color: #ffffff;"></i></button>
</form> --}}

<!-- Button trigger modal -->
<button type="button" class="btn btn-danger d-inline" data-bs-toggle="modal" data-bs-target="#exampleModal">
  <i class="fa-regular fa-trash-can" title="Elimina" style="color: #ffffff;"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>Vuoi davvero eliminare il progetto: {{ $project->title }}?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-rotate-left" style="color: #ffffff;"></i> Indietro</button>

        <form action="{{route('admin.projects.destroy', $project)}}" method="POST" class="d-inline">

          @csrf
          @method('DELETE')

          <button type="submit" class="btn btn-danger d-inline"><i class="fa-regular fa-trash-can" title="Elimina" style="color: #ffffff;"></i> Elimina</button>
        </form>
      </div>
    </div>
  </div>
</div>
