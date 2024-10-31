<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Password;

use App\Users\Application\Commands\Password\ChangePassword;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Users\Domain\Events\PasswordUpdate;
use Illuminate\Support\Facades\Event; 

class ChangePasswordHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(ChangePassword $command): void
    {

        $user = $this->userRepository->findById($command->userId);

        if ($user) {
            $newPassword = $command->newPassword; 
            $user->fill([
                'password' => Hash::make($newPassword), 
            ]);
            $user->save();

            Event::dispatch(new PasswordUpdate($user, $newPassword));
        }
    }
}




