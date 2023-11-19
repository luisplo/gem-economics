<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RewardRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'value' => 'required|integer|max_digits:5',
            'intervals_id' => 'required|exists:intervals,id',
            'frequency' => 'required|integer|max_digits:5',
        ];
    }
}
