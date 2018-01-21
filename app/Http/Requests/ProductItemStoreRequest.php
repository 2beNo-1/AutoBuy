<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductItemStoreRequest extends FormRequest
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
            'product_id' => 'required',
            'item' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => '请选择产品',
            'item.required' => '请填写条例内容',
        ];
    }

    public function filldata()
    {
        $data = [
            'product_id' => intval($this->input('product_id')),
        ];
        $data['item'] = explode("\r\n", $this->input('item'));

        return $data;
    }
}
