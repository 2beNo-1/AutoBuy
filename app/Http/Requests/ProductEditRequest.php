<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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
            'name' => 'required|max:128',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请填写产品名',
            'name.max' => '产品名最大128个字符',
        ];
    }

    public function filldata()
    {
        return [
            'name' => $this->input('name'),
            'old_charge' => round(floatval($this->input('old_charge')), 2),
            'now_charge' => round(floatval($this->input('now_charge')), 2),
            'num' => intval($this->input('num')),
            'sales_num' => intval($this->input('sales_num')),
            'description' => $this->input('description'),
        ];
    }
}
