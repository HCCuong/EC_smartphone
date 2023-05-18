<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'shipping_name' => 'required',
            'shipping_address' => 'required',
            'shipping_phone' => 'required',
            'shipping_mail' => 'required',
        ];
    }

    public function messages(){
        return [
            'shipping_name.required' => 'Vui lòng nhập tên khách hàng',
            'shipping_address.required' => 'Vui lòng nhập địa chỉ giao hàng',
            'shipping_phone.required' => 'Vui lòng nhập số điện thoại',
            'shipping_mail.required' => 'Vui lòng nhập địa chỉ email',
        ];
    }
}
