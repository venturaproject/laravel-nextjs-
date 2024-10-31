<?php

declare(strict_types=1);

namespace App\Users\Application\Queries\GetById;

use App\Users\Application\Queries\GetById\GetUserById;
use App\Users\Domain\Model\User;
use App\Users\Domain\Repository\UserRepositoryInterface;

class GetUserByIdHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(GetUserById $query): ?User
    {
        return $this->userRepository->findById($query->id);
    }
}
