<?php

use App\Console\Commands\SyncMailboxesCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(SyncMailboxesCommand::class)->everyTenMinutes();
