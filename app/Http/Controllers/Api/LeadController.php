<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request){

      //1. Ricevo i dati dal form in post
      //2. Verifico validità dei dati
      //3. Se non sono validi restituisco json con success= false e lista di errori
      //4. se sono validi salvo i dati nel db
      //5. invio la mail
      //6. restituisco json con success = true




    }
}
