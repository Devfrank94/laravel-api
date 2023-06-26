<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Models\Tecnology;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $direction = 'asc';
      $projects = Project::orderBy('id', $direction)->paginate(5);
      // dd($tecnologies);
      return view('admin.projects.index', compact('projects', 'direction'));
    }

    // funzion per filtrare id asc -> desc e viceversa
    public function orderby($direction)
    {
      $direction = $direction === 'asc' ? 'desc' : 'asc';
      $projects = Project::orderBy('id', $direction)->paginate(5);
      return view('admin.projects.index', compact('projects', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $types = Type::all();
      $tecnologies = Tecnology::all();
        return view('admin.projects.create', compact('types', 'tecnologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();
        // dd($form_data);
        $new_project = new Project();
        $form_data['slug'] = Project::generateSlug($form_data['title']);
        $form_data['date'] = date('Y-m-d');

        if(array_key_exists('thumb', $form_data)){

          // Prima di salvare, salvo nome immagine
          $form_data['image_original_name'] = $request->file('thumb')->getClientOriginalName();

          // Salvo immagine in uploads e con il parametro accanto salvo il precorso
          $form_data['image_path'] = Storage::put('uploads', $form_data['thumb']);
        };

        $new_project->fill($form_data);
        $new_project->save();

        //se ho inviato almeno una tecnologia
        if(array_key_exists('tecnologies', $form_data)){

          // faccio attach al project appena creatol'array tecnologies proveninte dal form
          $new_project->tecnologies()->attach($form_data['tecnologies']);

        };

        return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Type $type)
    {
      $types = Type::all();
      $date = date_create($project->date);
      $data_formatted = date_format($date, 'd/m/Y');
      return view('admin.projects.show', compact('project', 'data_formatted', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
      $types = Type::all();
      $tecnologies = Tecnology::all();
      
      return view('admin.projects.edit', compact('project', 'types', 'tecnologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
      $form_data = $request->all();


      if($project->title !== $form_data['title']){
        $form_data['slug'] = Project::generateSlug($form_data['title']);
      }else{
        // altrimenti salvo il slug il vecchio slug
        $form_data['slug']  = $project->slug;
      }

      if (array_key_exists('thumb', $form_data)) {
        // Verifica se esiste un'immagine precedente e, se presente, eliminala dallo storage
        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }

        // Prima di salvare, salva il nome originale dell'immagine
        $form_data['image_original_name'] = $request->file('thumb')->getClientOriginalName();

        // Salva l'immagine nella cartella "uploads" e memorizza il percorso
        $form_data['image_path'] = Storage::put('uploads', $request->file('thumb'));
    }


      $project->update($form_data);

      return redirect()->route('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
      if($project->image_path){
        Storage::disk('public')->delete($project->image_path);
      }
      $project->delete();
      return redirect()->route('admin.projects.index')->with('deleted', "Il progetto $project->title è stata eliminata correttamente");
    }
}
