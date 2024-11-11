<?php

namespace App\Shared\Infrastructure\Http\Controllers\Api;

use App\Users\Application\Commands\Create\CreateUser;
use App\Users\Application\Commands\Password\ChangePassword;
use App\Users\Application\Commands\Delete\DeleteUser;
use App\Users\Application\Commands\Update\UpdateUser;
use App\Users\Application\Commands\Create\CreateUserDTO;
use App\Users\Application\Commands\Password\ChangePasswordDTO; 
use App\Users\Application\Commands\Update\UpdateUserDTO; 
use App\Users\Application\Queries\GetById\GetUserById;
use App\Users\Application\Queries\GetAll\GetAllUsers;
use App\Users\Infrastructure\Requests\CreateUserRequest;
use App\Users\Infrastructure\Requests\ChangePasswordRequest;
use App\Users\Infrastructure\Requests\UpdateUserRequest;
use App\Shared\Application\Bus\Command\CommandBus;
use App\Shared\Application\Bus\Query\QueryBus;
use App\Shared\Infrastructure\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    protected CommandBus $commandBus;
    protected QueryBus $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function create(CreateUserRequest $request): JsonResponse
    {
        $dto = new CreateUserDTO(
            $request->validated()['name'],
            $request->validated()['email'],
            Hash::make($request->validated()['password']), 
            null 
        );

        $command = new CreateUser($dto);

        $user = $this->commandBus->handle($command);

        return response()->json($user, Response::HTTP_CREATED);
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $dto = new UpdateUserDTO(
            $id,
            $request->input('name'),
            $request->input('email'),
            $request->input('date_verified') 
        );
    
        $command = new UpdateUser(
            $dto->id,
            $dto->name,
            $dto->email,
            $dto->date_verified
        );
    
        $this->commandBus->handle($command);
    
        return response()->json(['message' => 'User updated successfully.'], Response::HTTP_OK);
    }
    

    public function show(int $id): JsonResponse
    {
        $query = new GetUserById($id);
        $user = $this->queryBus->handle($query);

        if (!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($user, Response::HTTP_OK);
    }


    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
    
        $user = $request->user();

        $dto = new ChangePasswordDTO($user->id, $request->validated()['new_password']);

        $command = new ChangePassword($dto->userId, $dto->newPassword); 

        try {
            $this->commandBus->handle($command);
            return response()->json(['message' => 'Password changed successfully.'], Response::HTTP_OK);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function deleteAccount(Request $request): JsonResponse
    {
        $user = $request->user();

        $command = new DeleteUser($user->id);

        $this->commandBus->handle($command);

        return response()->json(['message' => 'Account deleted successfully.'], Response::HTTP_OK);
    }


    public function getAllUsers(): JsonResponse
    {
        $query = new GetAllUsers();
        $users = $this->queryBus->handle($query);

        return response()->json($users, Response::HTTP_OK);
    }
}




