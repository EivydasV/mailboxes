<?php

namespace App\Http\Requests\Web;

use App\Rules\InDatabaseColumns;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FindAllMailboxesRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'address' => 'string|nullable',
            'column' => ['nullable', new InDatabaseColumns('mailboxes')],
            'operator' => ['nullable', Rule::in('contains', 'equal', 'not_equal')],
            'value' => 'string|nullable',
        ];
    }
}
