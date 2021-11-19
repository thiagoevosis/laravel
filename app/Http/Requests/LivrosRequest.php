<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class LivrosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo'=>'required|min:3|max:191',
            'autor'=>'required|min:3|max:191',
            'editora'=>'required|min:5|max:20',
            'ano'=>'required|numeric',
            'paginas'=>'required|numeric',
            'descricao'=>'required',
            'id_categoria'=>'required',
            'tipo'=>'required',
        ];
}
}
