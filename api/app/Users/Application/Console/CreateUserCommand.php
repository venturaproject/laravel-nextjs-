<?php

namespace App\Users\Application\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\Users\Application\Commands\Create\CreateUser;
use App\Users\Application\Commands\Create\CreateUserDTO;
use App\Shared\Application\Bus\Command\CommandBus;

class CreateUserCommand extends Command
{
    protected $signature = 'user:create {name} {email} {password}';
    protected $description = 'Create a new user';

    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        parent::__construct();
        $this->commandBus = $commandBus;
    }

    public function handle(): void 
    {
        // Obtén los argumentos y asegúrate de que no sean nulos o valores no válidos
        $name = $this->argument('name') ?? '';
        $email = $this->argument('email') ?? '';
        $password = $this->argument('password') ?? '';

        // Verifica que los valores son del tipo esperado
        if (!is_string($name) || !is_string($email) || !is_string($password)) {
            $this->error('Invalid input. All arguments must be strings.');
            return;
        }

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6', 
        ]);

        if ($validator->fails()) {
            $this->error('Validation failed:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return;
        }

        $dto = new CreateUserDTO($name, $email, $password, null);
        $command = new CreateUser($dto);

        $user = $this->commandBus->handle($command);

        $this->info("User {$user->getName()} created successfully with email {$user->getEmail()}");
    }
}





