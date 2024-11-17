<?php

declare(strict_types=1);

namespace MyTheresa\Apps\HealthCheck\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class HealthCheckController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            [
                'status' => 'Ok'
            ]
        );
    }
}
