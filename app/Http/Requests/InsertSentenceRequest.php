<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertSentenceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'text' => 'required|max:255|min:3|unique:sentences',
            'task_id' => 'required|gt:0|exists:tasks,id',
            'eng_translation' => 'required|max:255|min:1',
            'srb_translation' => 'required|max:255|min:1'
        ];
    }
}
