<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Providers;

use App\Shared\Application\Services\EmailService;
use App\Shared\Application\Services\ExcelExportService;
use App\Shared\Application\Bus\Query\QueryBus;
use Illuminate\Contracts\Debug\ExceptionHandler;
use App\Shared\Domain\Exceptions\Handler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Registrar el EmailService como singleton
        $this->app->singleton(EmailService::class, function ($app) {
            return new EmailService();
        });

        $this->app->singleton(ExcelExportService::class, function ($app) {
            return new ExcelExportService($app->make(QueryBus::class)); 
        });


        // Registrar el Handler de excepciones personalizado
        $this->app->singleton(ExceptionHandler::class, Handler::class);
    }

    public function boot(): void
    {
        $this->commands([
            \App\Shared\Application\Console\Commands\ShowInfoCommand::class,
            \App\Shared\Application\Console\Commands\TestJob::class,
            \App\Shared\Application\Console\Commands\ExportProductsCommand::class,
        ]);
    }
}

