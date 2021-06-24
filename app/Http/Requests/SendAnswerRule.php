<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendAnswerRule extends FormRequest
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
            'contact_id' => ['exists:contacts,id'],
            'answer' => ['required', 'max:190'],
        ];
    }

    public function messages()
    {
        return [
            'contact_id.exists' => 'お問い合わせが存在しません',
            'answer.required' => 'お問い合わせ内容を入力してください',
            'answer.max' => 'お問い合わせ内容は190文字以内でお願いいたします',
        ];
    }
}
