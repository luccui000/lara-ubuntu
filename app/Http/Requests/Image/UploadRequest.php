<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:20480' // 20MB
            ]
        ];
    }
    public function messages()
    {
        return [
            'image.required' => 'Vui lòng chọn file',
            'image.image' => 'File phải là hình ảnh',
            'image.mimes' => 'File không đúng định dạng',
            'image.max' => 'Chỉ được upload hình ảnh tối đa 20MB'
        ];
    }
}
