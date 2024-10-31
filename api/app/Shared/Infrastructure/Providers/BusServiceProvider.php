<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Providers;

use App\Shared\Application\Bus\Command\CommandBus;
use App\Shared\Application\Bus\Query\QueryBus;
use Illuminate\Support\ServiceProvider;

class BusServiceProvider extends ServiceProvider
{
    public function register(): void
    {

        $this->app->singleton(CommandBus::class, function ($app) {
            return new CommandBus();
        });

        $this->app->singleton(QueryBus::class, function ($app) {
            return new QueryBus();
        });
    }

    public function boot(): void
    {

    }
}



