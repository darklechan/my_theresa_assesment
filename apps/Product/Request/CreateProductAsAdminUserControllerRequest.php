<?php

declare(strict_types=1);

namespace MyTheresa\Apps\Product\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use MyTheresa\Src\Category\Domain\ValueObject\CategoryIdEnum;

class CreateProductAsAdminUserControllerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sku' => [
                'required',
                'string',
            ],
            'name' => [
                'required',
                'string',
            ],
            'category.*' => [
                'required',
                'int',
                Rule::in(CategoryIdEnum::LIST),
            ],
            'price' => [
                'required',
                'int'
            ],
            'discountPercentage' => [
                'sometimes',
                'string'
            ],
        ];
    }
}
