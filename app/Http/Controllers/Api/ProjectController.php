<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){

      $projects = Project::with('tecnologies', 'type')->get();

      return response()->json($projects);
    }


    public function projectDetail($slug){

      $project = Project::where('slug', $slug)->with('tecnologies', 'type')->first();

      return response()->json($project);
    }




}

