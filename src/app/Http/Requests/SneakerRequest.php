<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SneakerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
       
            'sneaker_name' => 'required',
            'hyper_level' => 'required',
            'price' => 'required',
            'release_date' => 'required',
      
        ];
    }
}
