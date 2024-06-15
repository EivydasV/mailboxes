<?php

declare(strict_types=1);

namespace App\Api;

use Illuminate\Support\Facades\Http;

class GeoApi
{
    private const API_URL = 'https://nominatim.openstreetmap.org/search';

    public function getCoordinates(string $address): ?array
    {
        $res = Http::get(self::API_URL, [
            'q' => $address,
            'format' => 'jsonv2',
            'limit' => 1,
        ]);

        abort_if($res->failed(), $res->status(), 'Failed to fetch coordinates');

        $json = $res->json();

        if (empty($json)) {
            return null;
        }

        return [
            'lat' => $json[0]['lat'],
            'lon' => $json[0]['lon'],
        ];
    }
}
