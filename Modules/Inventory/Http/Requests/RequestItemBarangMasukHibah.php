<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestItemBarangMasukHibah extends FormRequest
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
            'item_id'=>'required',
            'item_satuan_id' => 'required',
            'quantity'=>'required|numeric',
            'price' => 'required',
            'warehouse_id'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'numeric' => 'harus angka',
            'item_id.required' => 'silahkan isi',
            'item_satuan_id.required' => 'silahkan isi',
            'quantity.required' => 'silahkan isi',
            'price.required' => 'silahkan isi',
            'warehouse_id.required'=>'silahkan isi'
        ];
    }
}
