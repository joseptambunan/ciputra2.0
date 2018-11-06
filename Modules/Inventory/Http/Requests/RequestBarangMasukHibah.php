<?php

namespace Modules\Inventory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestBarangMasukHibah extends FormRequest
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
            'allItemStore' =>'required',
            'from_project_id' => 'required',
            'from_pt_id' => 'required',
            'tanggal_hibah' => 'required|date',
            'date_format ' =>'Y-m-d',
            'no_refrensi'=> 'required'
        ];
    }

    public function messages()
    {
        return [
            'allItemStore.required' => 'silahkan tambahkan item',
            'required' => 'silahkan diisi',
            'date'=>'hanya untuk input tanggal',
            'date_format'=> 'format tanggal salah, format: tahun-bulan-hari'
        ];
    }
}
