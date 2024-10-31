<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Create;

use App\Users\Application\Commands\Create\CreateUserDTO;

class CreateUser
{
    public CreateUserDTO $dto;

    public function __construct(CreateUserDTO $dto)
    {
        $this->dto = $dto;
    }
}
