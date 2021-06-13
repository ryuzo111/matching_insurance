<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPostRule extends FormRequest
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
            'title' => ['required'],
            'trouble_type' => ['required', 'integer', 'min:1', 'max:5'],
            'insurance_target' => ['required', 'integer', 'min:1', 'max:9'],
            'interested_insurances' => ['required', 'array'],
            'interested_insurances.*' => ['in:life,medical,cancer,pension,saving,all_life,home,other'],
            'trouble_content' => ['required', 'max:255'],            
        ];
    }

    public function messages() {
        return [
            'title.required' => '「タイトル」は入力必須です。',

            'trouble_type.required' => '「悩みのタイプ」は入力必須です。',
            'trouble_type.min' => '「悩みのタイプ」に不正な値が入力されました。',
            'trouble_type.max' => '「悩みのタイプ」に不正な値が入力されました。',
            'trouble_type.integer' => '「悩みのタイプ」に不正な値が入力されました。',

            'insurance_target.required' => '「誰に対する悩み？」は入力必須です。',
            'insurance_target.min' => '「誰に対する悩み？」に不正な値が入力されました。',
            'insurance_target.max' => '「誰に対する悩み？」に不正な値が入力されました。',
            'insurance_target.integer' => '「誰に対する悩み？」に不正な値が入力されました。',

            'interested_insurances.required' => '「興味のある保険」は入力必須です。',
            'interested_insurances.array' => '「興味のある保険」に不正な値が入力されました。',
            'interested_insurances.*.in' => '「興味のある保険」に不正な値が入力されました。',

            'trouble_content.required' => '「悩みの内容」は入力必須です。',
            'trouble_content.max' => '「悩みの内容」は255文字以内でお願いいたします',
        ];
    }
}
