<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Schema;
use Illuminate\Translation\PotentiallyTranslatedString;

class InDatabaseColumns implements ValidationRule
{
    public function __construct(private readonly string $table)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $columns = Schema::getColumnListing($this->table);

        if (!in_array($value, $columns)) {
            $fail("The $attribute must be one of the columns in the $this->table table.");
        }
    }
}
