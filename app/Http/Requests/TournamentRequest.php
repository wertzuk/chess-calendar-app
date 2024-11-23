<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TournamentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:100',
            'time_control' => 'required|max:200',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'chess_type' => 'required',
            'city' => 'required|max:50',
            'number_of_rounds' => 'nullable|integer',
            'street' => 'nullable|max:50',
            'plz' => 'nullable|integer',
            'elo_rated' => 'boolean',
            'dwz_rated' => 'boolean',
            'blitz_elo_rated' => 'boolean',
            'rapid_elo_rated' => 'boolean',
            'chess_results_link' => 'nullable|url',
            'website_link' => 'nullable|url',
            'announcement_link' => 'nullable|url',
        ];
    }
}
