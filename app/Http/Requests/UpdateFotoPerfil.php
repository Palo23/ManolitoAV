<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFotoPerfil extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'profile-picture' => 'required|image'
        ];
    }

    public function messages() 
    {
        return [
            'profile-picture.required' => 'No has seleccionado ningun archivo.',
            'profile-picture.image' => 'Debes subir una imagen.',
        ];
    }
}
