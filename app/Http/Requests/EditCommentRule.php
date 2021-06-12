<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCommentRule extends FormRequest
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
            'comment_id' => ['required', 'exists:comments,id'],
            'comment' => ['required', 'max:190'],
        ];
    }
    public function messages()
    {
        return [
            'comment_id.required' => 'コメントが見つかりません',
            'comment_id.exists' => 'コメントが見つかりません',
            'comment.required' => 'コメントを入力してください',
            'comment.max' => 'コメントは190文字以内でお願いいたします',
        ];
    }
}
