<?php

declare(strict_types=1);

namespace App\Users\Domain\Events;

use App\Users\Domain\Model\User;

class PasswordUpdate
{
    private User $user;
    private string $newPassword; 

    public function __construct(User $user, string $newPassword)
    {
        $this->user = $user;
        $this->newPassword = $newPassword; 
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getNewPassword(): string 
    {
        return $this->newPassword;
    }
}
