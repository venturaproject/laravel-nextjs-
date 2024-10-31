<?php

declare(strict_types=1);

namespace App\Users\Application\Queries\GetById;

class GetUserById
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
