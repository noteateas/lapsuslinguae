<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertWordRequest extends FormRequest
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
            'text' => 'required|max:255|min:1|unique:words',
            'word_category_id' => 'required|gt:0|exists:word_categories,id',
            'word_type_id' => 'required|gt:0|exists:word_types,id',
            'eng_translation' => 'required|max:255|min:1',
            'srb_translation' => 'required|max:255|min:1',
            'audio_file' => 'required|file|mimes:mp3'
        ];
    }
}
