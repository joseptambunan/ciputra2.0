<?php

namespace Modules\Inventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPeriodeOpName extends FormRequest
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
            'periode' => 'required',
            //'start_opname'=>'required',
           // 'end_opname'=>'required',
            'warehouse_id'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'required'=>'silahkan isi'
        ];
    }
}
