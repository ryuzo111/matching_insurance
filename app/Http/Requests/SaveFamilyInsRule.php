<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SaveFamilyInsRule extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		$age_check = function ($attribute, $value, $fail) {
			$input_data = $this->all();
			if ($input_data['relationship'] == 1) {
				if ($input_data['age'] != Auth::user()->age) {
					$fail('ご本人の年齢は、プロフィールの情報と合わせてください');
				}
			}
		};
		return [
			'relationship' => ['required', 'integer', 'between:1,7', $age_check],
			'age' => ['nullable', 'integer', 'between:0,125'],
			'have_insurance_company' => ['nullable', 'max:255'],
			'have_insurance_content' => ['required', 'max:255'],
		];
	}

	public function messages() {
		return [
			'relationship.between' => '続柄がプルダウンから選択されていません',
			'age.between' => '年齢が正しいか確認してください',
		];
	}
}
