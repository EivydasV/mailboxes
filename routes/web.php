<?php

use App\Http\Controllers\Web\MailboxController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('mailboxes');
});

Route::get('/mailboxes', [MailboxController::class, 'index'])->name('mailboxes');

