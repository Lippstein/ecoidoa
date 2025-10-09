<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersDataFlexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Adicione os campos e regras conforme sua tabela e necessidade
            'user_id'    => ['required', 'integer', 'exists:users,id'],
            'niche_id'   => ['required', 'integer', 'exists:niches,id'],
            'habitat_id' => ['required', 'integer', 'exists:habitats,id'],
        ];

    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'O campo user id é obrigatório.',
            'niche_id.required' => 'O campo niche id é obrigatório.',
            'habitat_id.required' => 'O campo habitat id é obrigatório xxxxx.',
        ];
    }
}
