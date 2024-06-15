<?php

declare(strict_types=1);

namespace App\Api;

use App\Formatter\CsvFormatter;
use Illuminate\Support\Facades\Http;

class MailboxApi
{
    private const API_URL = 'https://www.omniva.ee/locations.csv';

    public function __construct(private readonly CsvFormatter $csvFormatter)
    {
    }

    public function getMailboxes(): array
    {
        $res = Http::get(self::API_URL);
        abort_if($res->failed(), $res->status(), 'Failed to fetch mailboxes');

        $mailboxes = $res->body();

        return $this->csvFormatter->toArray($mailboxes);
    }
}
