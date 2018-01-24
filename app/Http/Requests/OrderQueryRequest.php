<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderQueryRequest extends FormRequest
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
            'oid' => 'required',
            'info' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'oid.required' => '请输入订单号',
            'oid.info' => '请输入手机号或邮箱',
        ];
    }

    public function filldata()
    {
        return [
            'oid' => $this->post('oid'),
            'info' => $this->post('info'),
        ];
    }
}
