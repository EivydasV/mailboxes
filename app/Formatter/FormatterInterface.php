<?php

namespace App\Formatter;

interface FormatterInterface
{
    public function toArray(string $input): array;
}
