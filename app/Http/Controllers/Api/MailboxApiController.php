<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FindNearestMailboxesApiRequest;
use App\Services\MailboxService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class MailboxApiController extends Controller
{
    public function __construct(private readonly MailboxService $mailboxService)
    {
    }

    public function nearestMailboxes(FindNearestMailboxesApiRequest $request): JsonResponse
    {
        $address = $request->validated('address');
        ['mailboxes' => $mailboxes] = $this->mailboxService->index(null, null, null, $address);
        if ($mailboxes instanceof LengthAwarePaginator) {
            return response()->json(
                ['error' => 'Failed to find any mailboxes near the provided address.'],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json($mailboxes);
    }
}
