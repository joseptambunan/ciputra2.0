<?php

namespace Modules\Inventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestWarehouse extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'code'=>'required|unique:warehouses',
            'name'=>'required',
            'department_id'=>'required'

        ];
    }
    public function messages()
    {
        return [
            'required'=>'silahkan isi',
            'unique'=>'Kode Sudah ada'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
