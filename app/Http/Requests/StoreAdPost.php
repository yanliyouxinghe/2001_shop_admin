<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreAdPost extends FormRequest
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
            'ad_name' => [
                'required',
                Rule::unique('sh_ad')->ignore(request()->id,'ad_id'),
            ],
            'ad_width' => 'required',
        ];
    }

    public function messages(){ 
        return [ 
            'ad_name.required' => '广告位置名称必填', 
            'ad_name.unique' => '广告位置名称已存在',
            'ad_width.required' => '广告位置宽度必填',
            ]; 
        }
}
