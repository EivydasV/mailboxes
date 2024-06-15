<?php

declare(strict_types=1);

namespace App\QueryConverter;

use http\Exception\InvalidArgumentException;

class ConvertStringToSqlConverter
{

    /**
     * @return string[]
     */
    public function convert(string $column, string $operator, string $value): array
    {
        $operator = $this->replaceOperator($operator);
        $value = $this->replaceValue($operator, $value);

        return [$column, $operator, $value];
    }

    private function replaceValue(string $operator, string $value): string
    {
        return match ($operator) {
            'like' => '%' . $value . '%',
            default => $value,
        };
    }

    private function replaceOperator(string $operator): string
    {
        return match ($operator) {
            'equal' => '=',
            'not_equal' => '!=',
            'contains' => 'like',
            default => throw new InvalidArgumentException('Invalid operator'),
        };
    }
}
