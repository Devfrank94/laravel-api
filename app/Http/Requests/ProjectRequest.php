<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
      return [
        'title' => 'required|min:3|max:255',
        'description' => 'required',
        'image' => 'required',
        'type_id' => 'required',
      ];
    }

    public function messages()
    {
        return[
            // Campi richiesti
            'title.required' => 'Il Titolo è un campo obbligatorio',
            'description.required' => 'La Descrizione è un campo obbligatorio',
            'image.required' => 'L\' immagine è un campo obbligatorio',
            'type_id.required' => 'Il Tipo sviluppo è un campo obbligatorio',

            // Caratteri massimi
            'title.max' => 'Il Titolo può contenere al massimo :max caratteri',

            // Caratteri Minimi o condizioni varie
            'title.min' => 'Il Titolo può contenere minimo :min caratteri',

        ];
    }
}
