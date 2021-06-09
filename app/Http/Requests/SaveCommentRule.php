<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCommentRule extends FormRequest
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
            'post_id' => ['required', 'exists:posts,id'],
            'comment' => ['required', 'max:190'],
        ];
    }
    public function messages()
    {
        return [
            'post_id.required' => 'コメントする投稿が見つかりません',
            'post_id.exists' => 'コメントする投稿が見つかりません',
            'comment.required' => 'コメントを入力してください',
            'comment.max' => 'コメントは190文字以内でお願いいたします',
        ];
    }
}
