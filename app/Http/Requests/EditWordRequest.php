<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditWordRequest extends FormRequest
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
            'text' => 'required|max:255|min:1',
            'word_category_id' => 'required|gt:0|exists:word_categories,id',
            'word_type_id' => 'required|gt:0|exists:word_types,id',
            'eng_translation' => 'required|max:255|min:1',
            'srb_translation' => 'required|max:255|min:1',
            'audio_file' => 'nullable|file|mimes:mp3'
        ];
    }
}
