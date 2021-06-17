<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditPassRule extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'password' => ['required', 'string', 'min:6', 'confirmed'],
			'current_password' => [
				'required',
				function ($attribute, $value, $fail) {
					if (!Hash::check($value, Auth::user()->password)) {
						$fail('現在のパスワードが異なります');
					}
				}
			],
		];
	}
}
