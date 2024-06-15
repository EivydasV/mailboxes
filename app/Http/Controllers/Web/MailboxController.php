<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\FindAllMailboxesRequest;
use App\Services\MailboxService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class MailboxController extends Controller
{
    public function __construct(private readonly MailboxService $mailboxService)
    {
    }

    public function index(FindAllMailboxesRequest $request): View
    {
        $column = $request->validated('column');
        $operator = $request->validated('operator');
        $value = $request->validated('value');
        $address = $request->validated('address');

        ['columns' => $columns, 'mailboxes' => $mailboxes] =  $this->mailboxService->index(
            $column,
            $operator,
            $value,
            $address
        );

        if ($address && $mailboxes instanceof LengthAwarePaginator) {
            $request->session()->now('error', 'Failed to find any mailboxes near the provided address.');
        }


        return view('mailbox.index', compact('mailboxes', 'columns'));
    }
}
