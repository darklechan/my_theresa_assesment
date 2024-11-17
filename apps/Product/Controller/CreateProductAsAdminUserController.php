<?php

declare(strict_types=1);

namespace MyTheresa\Apps\Product\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use MyTheresa\Apps\Product\Request\CreateProductAsAdminUserControllerRequest;
use MyTheresa\Src\Product\Application\Request\CreateProductAsAdminUserUseCaseRequest;
use MyTheresa\Src\Product\Application\UseCase\CreateProductAsAdminUserUseCase;

class CreateProductAsAdminUserController extends Controller
{
    public function __invoke(
        CreateProductAsAdminUserControllerRequest $request,
        CreateProductAsAdminUserUseCase $useCase,
    ): JsonResponse {
        $useCaseRequest = CreateProductAsAdminUserUseCaseRequest::create(
            $request->get('sku'),
            $request->get('name'),
            $request->get('category'),
            $request->get('price'),
            $request->get('discountPercentage'),
        );

        $useCase->execute($useCaseRequest);

        return new JsonResponse();
    }
}
