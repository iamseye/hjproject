<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProductRequest extends Request
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
        $rules=[
            'title'=> 'required',
            'price'=> 'required',
            'pics_path.0'=>'required'
        ];


        $nbr = count($this->input('pics_path')) - 1;

        foreach(range(0, $nbr) as $index) {
            $rules['pics_path.' . $index] = 'image';
        }


        return $rules;
    }

    public function messages()
    {
        $msgs=[
            'title.required' => '請輸入標題',
            'price.required' => '請輸入價格',
            'pics_path.0.required' => '必須上傳圖片',
            'pics_path.*.image' => '請上傳圖片正確格式',
        ];

        $nbr = count($this->input('pics_path')) - 1;

        foreach(range(0, $nbr) as $index) {
            $rules['pics_path.' . $index.'.image'] = '請上傳圖片正確格式';
        }


        return $msgs;

    }

}
