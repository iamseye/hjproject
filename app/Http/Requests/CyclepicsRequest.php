<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CyclepicsRequest extends Request
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
            'title'=>'required',
            'save_path'=>'image'
        ];
    }

    public function messages()
    {
        $msgs=[
            'title.required' => '請輸入標題',
            'pics_path.image' => '請上傳圖片正確格式',
        ];

        return $msgs;

    }
}
