<?php

declare(strict_types=1);

namespace MyTheresa\Apps\Product\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use MyTheresa\Apps\Product\Request\GetProductListAsAdminUserControllerRequest;
use MyTheresa\Src\Product\Application\Request\GetProductListAsAdminUserUseCaseRequest;
use MyTheresa\Src\Product\Application\UseCase\GetProductListAsAdminUserUseCase;

class GetProductListAsAdminUserController extends Controller
{
    public function __invoke(
        GetProductListAsAdminUserControllerRequest $controllerRequest,
        GetProductListAsAdminUserUseCase $useCase,
    ): JsonResponse {
        $page = $controllerRequest->query('page');
        $itemsPerPage = $controllerRequest->query('itemsPerPage');
        $category = (int)(string) $controllerRequest->query('category');

        $response = $useCase->execute(
            GetProductListAsAdminUserUseCaseRequest::create(
                $page,
                $itemsPerPage,
                $category
            )
        );

        return new JsonResponse($response);
    }
}
