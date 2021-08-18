<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProfileRule extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:30'],
			'email' => ['required', 'string', 'email', 'max:255',
				Rule::unique('users')->ignore($this->id),
			],
            'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'age' => ['nullable', 'integer', 'between:0,125'],
			'sex' => ['nullable', 'integer', 'between:1,2'],
            'insurance_company' => ['nullable', 'max:50'],
            'spouse' => ['nullable', 'between:0,1'],
            'children' => ['nullable', 'integer', 'min:0'],
			'house_type' => ['nullable', 'integer', 'between:1,7'],
			'pref' => ['nullable', 'integer', 'between:1,47'],
            'free_comment' => ['nullable', 'max:255'],
        ];
	}

    public function messages() {
        return [
			'image.max' => '5Mバイトより大きいサイズの画像はアップロードできません',
			'age.between' => '年齢が正しいか確認してください',
			'spouse.between' => '配偶者数が正しいか確認してください',
			'sex.integer' => '性別がプルダウンから選択されていません',
			'sex.between' => '性別がプルダウンから選択されていません',
			'house_type.integer' => '家の種類がプルダウンから選択されていません',
			'house_type.between' => '家の種類がプルダウンから選択されていません',
			'pref.integer' => '都道府県がプルダウンから選択されていません',
			'pref.between' => '都道府県がプルダウンから選択されていません',
        ];
    }
}
