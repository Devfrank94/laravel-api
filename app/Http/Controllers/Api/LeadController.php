<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request){


    //1. Ricevo i dati dal form in post
    $data = $request->all();

    //2. Verifico validità dei dati
    $validator = Validator::make($data,
    [
      'name' => 'required|min:3|max:255',
      'email' => 'required|email|min:5|max:255',
      'message' => 'required|min:10'
    ],
    [
      'name.required' => 'Il titolo è richiesto',
      'name.min' => 'Il titolo deve avere minimo :min caratteri',
      'name.max' => 'Il titolo può avere massimo :max caratteri',
      'email.required' => 'L\'email è richiesta',
      'email.email' => 'L\'email inserita non ha un formato corretto',
      'email.min' => 'L\'email deve avere minimo :min caratteri',
      'email.max' => 'L\'email può avere massimo :max caratteri',
      'message.required' => 'Il messaggio è richiesto',
      'message.min' => 'Il messaggio può avere minimo :min caratteri',
      ]
    );

    //3. Se non sono validi restituisco json con success= false e lista di errori
    if($validator->fails()){
      $success = false;
      $errors = $validator->errors();
      return response()->json(compact('success', 'errors'));
    }

    //4. se sono validi salvo i dati nel db
    $new_lead = new Lead();
    $new_lead->fill($data);
    $new_lead->save();

    //5. invio la mail
    Mail::to('francescomurro94@gmail.com')->send(new NewContact($new_lead));

    //6. restituisco json con success = true
    $success = true;
    return response()->json(compact('success'));
  }
}

