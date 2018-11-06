<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestMutasiInValidationDepartemen extends FormRequest
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
            //
            'department'=>'required',
            'asset_id'=>'required'
        ];
    }

    public function messages()
    {

        return [
            'required'=>'silahkan diisi!',
            'asset_id.required'=>'data belum lengkap'
        ];
    }
}
