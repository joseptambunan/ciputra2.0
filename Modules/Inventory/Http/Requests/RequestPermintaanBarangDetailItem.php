<?php

namespace Modules\Inventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPermintaanBarangDetailItem extends FormRequest
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
            'item_id'=>'required',
            'quantity'=>'required|numeric',
            'butuh_date'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            'item_id.required' => 'silahkan isi',
            'quantity.required' => 'silahkan isi',
            'butuh_date.required' => 'silahkan isi',
            'numeric'=>'harus angka'
        ];
    }
}
