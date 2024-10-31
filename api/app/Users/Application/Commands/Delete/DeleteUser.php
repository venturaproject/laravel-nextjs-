<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Delete;

class DeleteUser
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}