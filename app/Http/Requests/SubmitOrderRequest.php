<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitOrderRequest extends FormRequest
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
            'mobile' => 'required',
            'email' => 'required|email',
            'pay_way' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => '请输入手机号',
            'email.required' => '请输入邮箱',
            'email.email' => '请输入有效邮箱',
            'pay_way.required' => '请选择支付方式',
        ];
    }

    public function filldata()
    {
        return [
            'mobile' => $this->input('mobile'),
            'email' => $this->input('email'),
            'buy_num' => intval($this->input('buy_num')),
            'pay_way' => $this->input('pay_way'),
        ];
    }
}
