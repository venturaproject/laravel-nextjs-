<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Create;

use App\Users\Application\Commands\Create\CreateUser;
use App\Users\Domain\Model\User;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class CreateUserHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(CreateUser $command): User
    {

        $hashedPassword = Hash::make($command->dto->password);

        $user = new User();
        $user->fill([
            'name' => $command->dto->name,     
            'email' => $command->dto->email,    
            'password' => $hashedPassword,      
        ]);

  
        $this->userRepository->save($user);

        return $user;
    }
}



