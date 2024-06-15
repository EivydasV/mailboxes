<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\ApiKeyService;
use Illuminate\Console\Command;

class CreateApiKeyCommand extends Command
{
    public function __construct(private readonly ApiKeyService $apiKeyService)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-api-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new API key.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $apiKey = $this->apiKeyService->createApiKey();

        $this->info("API key created: {$apiKey->key}");
    }
}
