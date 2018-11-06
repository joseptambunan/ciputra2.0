<?php

namespace Modules\Inventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPermintaanBarangDetail extends FormRequest
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

            'permintaanbarang_id'=>'required'
        ];
    }
    public function messages()
    {
        return [

            'permintaanbarang_id.required' => 'silahkan isi nomor permintaan barang'
        ];
    }
}
