<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Providers;

use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Users\Infrastructure\Repository\UserRepository;
use App\Users\Application\Commands\Create\CreateUser;
use App\Users\Application\Commands\Update\UpdateUser;
use App\Users\Application\Commands\Delete\DeleteUser;
use App\Users\Application\Commands\Password\ChangePassword;
use App\Users\Application\Commands\Create\CreateUserHandler;
use App\Users\Application\Commands\Update\UpdateUserHandler;
use App\Users\Application\Commands\Delete\DeleteUserHandler;
use App\Users\Application\Commands\Password\ChangePasswordHandler;
use App\Users\Application\Queries\GetAll\GetAllUsersHandler;
use App\Users\Application\Queries\GetAll\GetAllUsers;
use App\Users\Application\Queries\GetById\GetUserByIdHandler;
use App\Users\Application\Queries\GetById\GetUserById;
use App\Users\Domain\Events\PasswordUpdate;
use App\Users\Infrastructure\Listeners\SendPasswordUpdateEmailListener;
use App\Shared\Application\Bus\Command\CommandBus;
use App\Shared\Application\Bus\Query\QueryBus;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event; 

class UsersServiceProvider extends ServiceProvider
{
    public function register(): void
    {

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->resolving(QueryBus::class, function (QueryBus $queryBus, $app) {

            $queryBus->registerHandler(GetAllUsers::class, fn($query) => $app->make(GetAllUsersHandler::class)->handle($query));

            $queryBus->registerHandler(GetUserById::class, fn(GetUserById $query) => $app->make(GetUserByIdHandler::class)->handle($query));
        });

        $this->app->resolving(CommandBus::class, function (CommandBus $commandBus, $app) {

            $commandBus->registerHandler(CreateUser::class, fn(CreateUser $command) => $app->make(CreateUserHandler::class)->handle($command));

            $commandBus->registerHandler(UpdateUser::class, fn(UpdateUser $command) => $app->make(UpdateUserHandler::class)->handle($command));

            $commandBus->registerHandler(DeleteUser::class, fn(DeleteUser $command) => $app->make(DeleteUserHandler::class)->handle($command));

            $commandBus->registerHandler(ChangePassword::class, fn(ChangePassword $command) => $app->make(ChangePasswordHandler::class)->handle($command));
        });
    }

    public function boot(): void
    {
        $this->commands([\App\Users\Application\Console\CreateUserCommand::class]);
        
        Event::listen(PasswordUpdate::class, SendPasswordUpdateEmailListener::class);
    }
}



