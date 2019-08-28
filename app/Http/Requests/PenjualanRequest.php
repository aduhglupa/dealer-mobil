<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjualanRequest extends FormRequest
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
            'nama_pembeli' => 'required',
            'email_pembeli' => 'required',
            'telp_pembeli' => 'required|digits_between:11,14',
            'details' => 'required',
            'details.*.jumlah' => 'required|numeric|min:1'
        ];
    }
}
