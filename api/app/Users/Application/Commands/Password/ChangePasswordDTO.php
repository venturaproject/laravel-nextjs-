<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Password;

class ChangePasswordDTO
{
    public int $userId; 
    public string $newPassword; 

    public function __construct(int $userId, string $newPassword)
    {
        $this->userId = $userId;
        $this->newPassword = $newPassword;
    }
}
