<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Update;

class UpdateUser
{
    public int $id;
    public ?string $name;
    public ?string $email;
    public ?string $date_verified; 

    public function __construct(int $id, ?string $name, ?string $email, ?string $date_verified)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->date_verified = $date_verified;
    }
}