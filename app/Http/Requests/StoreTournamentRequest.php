<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTournamentRequest extends FormRequest
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
            'title' => 'required',
            'time_control' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'chess_type' => 'required',
            'city' => 'required',
            'elo_rated' => 'boolean',
            'dwz_rated' => 'boolean',
            'blitz_elo_rated' => 'boolean',
            'rapid_elo_rated' => 'boolean',
        ];
    }
}
