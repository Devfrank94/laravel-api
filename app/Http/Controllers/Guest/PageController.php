<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('guest.home');
    }

    public function contacts(){
        return view('guest.contacts');
    }
}
