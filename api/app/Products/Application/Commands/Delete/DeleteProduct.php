<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Delete;

class DeleteProduct
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
