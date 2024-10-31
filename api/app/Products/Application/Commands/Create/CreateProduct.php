<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Create;

use App\Products\Application\Commands\Create\CreateProductDTO;

class CreateProduct
{
    public CreateProductDTO $dto;

    public function __construct(CreateProductDTO $dto)
    {
        $this->dto = $dto;
    }
}
