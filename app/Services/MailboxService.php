<?php

declare(strict_types=1);

namespace App\Services;

use App\Api\GeoApi;
use App\Api\MailboxApi;
use App\Models\Mailbox;
use App\QueryConverter\ConvertStringToSqlConverter;
use Illuminate\Support\Facades\Schema;

class MailboxService
{
    public function __construct(
        private readonly MailboxApi $mailboxApiService,
        private readonly ConvertStringToSqlConverter $convertStringToSqlConverter,
        private readonly GeoApi $geoApi
    ) {
    }

    public function index(?string $column, ?string $operator, ?string $value, ?string $address): array
    {
        $columns = Schema::getColumnListing('mailboxes');
        $mailboxQuery = Mailbox::query();

        if ($address) {
            $coordinates = $this->geoApi->getCoordinates($address);
            $mailboxQuery->when($coordinates, function ($query, $coordinates) {
                return $query->nearby($coordinates['lat'], $coordinates['lon'])
                    ->orderBy('distance')
                    ->limit(5);
            });
        }

        if ($column && $operator && $value) {
            [$column, $operator, $value] = $this->convertStringToSqlConverter->convert(
                $column,
                $operator,
                $value
            );

            $mailboxQuery->where($column, $operator, $value);
        }

        return [
            'mailboxes' => $coordinates ? $mailboxQuery->get() : $mailboxQuery->paginate(6),
            'columns' => $columns
        ];
    }

    public function syncMailboxes(): void
    {
        Mailbox::truncate();
        $mailboxes = $this->mailboxApiService->getMailboxes();
        Mailbox::insert($mailboxes);
    }
}
