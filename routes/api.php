<?php

use App\Http\Controllers\Api\MailboxApiController;
use Illuminate\Support\Facades\Route;

Route::get('/nearestMailboxes', [MailboxApiController::class, 'nearestMailboxes'])->middleware(['throttle_api_key:10,1', 'api_key']);
