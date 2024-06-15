<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ApiKey;
use Illuminate\Support\Str;

class ApiKeyService
{
    public function createApiKey() {
        return ApiKey::create([
            'key' => Str::random(64)
        ]);
    }
}
