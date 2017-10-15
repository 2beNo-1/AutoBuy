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
            'is_multi' => 'required',
            'item' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => '请选择产品',
            'is_multi.required' => '请选择类型',
            'item.required' => '请填写条例内容',
        ];
    }

    public function filldata()
    {
        $data = [
            'product_id' => intval($this->input('product_id')),
            'is_multi' => intval($this->input('is_multi')),
        ];
        if ($data['is_multi']) {
            $data['item'] = explode("\r\n", $this->input('item'));
        } else {
            $data['item'] = $this->input('item');
        }

        return $data;
    }
}
