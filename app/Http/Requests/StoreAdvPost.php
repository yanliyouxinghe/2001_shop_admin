<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreAdvPost extends FormRequest
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
            'adv_name' => [
                'required',
                Rule::unique('sh_adv')->ignore(request()->id,'adv_id'),
            ],
        ];
    }

    public function messages(){ 
        return [ 
            'adv_name.required' => '广告名称必填', 
            'adv_name.unique' => '广告名称已存在',
             ];
     }
}
