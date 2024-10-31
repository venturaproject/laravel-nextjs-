<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Update;

use App\Users\Application\Commands\Update\UpdateUser;
use App\Users\Domain\Model\User;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateUserHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(UpdateUser $command): User
    {
    
        try {
            $user = $this->userRepository->findById($command->id);

            if (!$user) {
                throw new ModelNotFoundException("User not found");
            }

            $user->update(array_filter([
                'name' => $command->name,
                'email' => $command->email,
                'date_verified' => $command->date_verified,
            ]));

            return $user;

        } catch (ModelNotFoundException $e) {
       
            throw $e; 
        }
    }
}

