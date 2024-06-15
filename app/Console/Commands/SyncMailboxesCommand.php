<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\MailboxService;
use Illuminate\Console\Command;

class SyncMailboxesCommand extends Command
{
    public function __construct(private readonly MailboxService $mailboxService)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-mailboxes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync mailboxes from the API';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->mailboxService->syncMailboxes();
    }
}
