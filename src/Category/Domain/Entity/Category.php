<?php

declare(strict_types=1);

namespace MyTheresa\Src\Category\Domain\Entity;

use Illuminate\Database\Eloquent\Model;
use MyTheresa\Src\Category\Domain\ValueObject\CategoryId;
use MyTheresa\Src\Category\Domain\ValueObject\CategoryIdEnum;
use MyTheresa\Src\Category\Domain\ValueObject\CategoryNameEnum;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'category_id';

    public function id(): CategoryId
    {
        return new CategoryId($this->getAttributeValue('category_id'));
    }

    public function setId(CategoryId $categoryId): self
    {
        return $this->setAttribute('category_id', $categoryId->value());
    }

    public function categoryName(): CategoryNameEnum
    {
        return new CategoryNameEnum($this->getAttributeValue('category_name'));
    }

    public function setCategoryName(CategoryNameEnum $categoryName): self
    {
        return $this->setAttribute('category_id', $categoryName->getValue());
    }
}
