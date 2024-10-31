<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Create;

class CreateUserDTO
{
    public string $name;
    public string $email;
    public string $password; 
    public ?string $date_verified; 

    public function __construct(string $name, string $email, string $password, ?string $date_verified)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->date_verified = $date_verified;
    }
}
