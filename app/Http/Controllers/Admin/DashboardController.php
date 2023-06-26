<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;


class DashboardController extends Controller
{
    public function index(){

      $num_projects = Project::all()->count();

      $last_project = Project::orderBy('id', 'desc')->first();

      return view('admin.home', compact('num_projects', 'last_project'));
    }

    public function stats(){
        return view('admin.stats');
    }
}
