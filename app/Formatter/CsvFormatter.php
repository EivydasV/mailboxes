<?php

declare(strict_types=1);

namespace App\Formatter;

class CsvFormatter implements FormatterInterface
{
    public function toArray(string $input): array
    {
        $csv = $this->removeBom($input);

        $rows = $this->getRows($csv);

        /** @var array $headers */
        $headers = array_shift($rows);
        array_walk($headers, function(&$header) {
            $header = strtolower($header);
        });

        $rows = $this->filterRows($rows, $headers);

        return array_map(function($row) use ($headers) {
            return array_combine($headers, $row);
        }, $rows);

    }

    private function filterRows(array $rows, array $headers): array
    {
        return array_filter($rows, function($row) use ($headers) {
            return count($headers) === count($row);
        });
    }

    private function getRows(string $csv): array
    {
        $rows = explode("\n", $csv);

        return array_map(function($row) {
            return str_getcsv($row, ';');
        }, $rows);
    }

    private function removeBom(string $csv): string
    {
        $bom = pack('H*','EFBBBF');

        return preg_replace("/^$bom/", '', $csv);
    }
}
