<?php

declare(strict_types=1);

namespace MyTheresa\Apps\Product\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use MyTheresa\Src\Category\Domain\ValueObject\CategoryIdEnum;

class GetProductListAsAdminUserControllerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => [
                'integer',
                'sometimes',
            ],
            'itemsPerPage' => [
                'integer',
                'sometimes',
            ],
            'category.*' => [
                'int',
                'sometimes',
                Rule::in(CategoryIdEnum::LIST),
            ]
        ];
    }
}
