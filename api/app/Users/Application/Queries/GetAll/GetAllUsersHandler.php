<?php

declare(strict_types=1);

namespace App\Users\Application\Queries\GetAll;

use App\Users\Application\Queries\GetAll\GetAllUsers;
use App\Users\Domain\Model\User;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetAllUsersHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handles the query to retrieve all userts.
     *
     * @param GetAllUsers $query
     * @return Collection<int, User> Collection of User objects
     */
    public function handle(GetAllUsers $query): Collection
    {
        return $this->userRepository->findAll();
    }
}
