<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Providers;

use App\Products\Domain\Events\ProductCreated;
use App\Products\Domain\Repository\ProductRepositoryInterface;
use App\Products\Infrastructure\Listeners\SendProductCreatedEmailListener;
use App\Products\Infrastructure\Repository\ProductRepository;
use App\Products\Application\Commands\Create\CreateProduct;
use App\Products\Application\Commands\Update\UpdateProduct;
use App\Products\Application\Commands\Delete\DeleteProduct;
use App\Products\Application\Commands\Create\CreateProductHandler;
use App\Products\Application\Commands\Update\UpdateProductHandler;
use App\Products\Application\Commands\Delete\DeleteProductHandler;
use App\Products\Application\Queries\GetAll\GetAllProductsHandler;
use App\Products\Application\Queries\GetAll\GetAllProducts;
use App\Products\Application\Queries\GetById\GetProductByIdHandler;
use App\Products\Application\Queries\GetById\GetProductById;
use App\Shared\Application\Bus\Command\CommandBus;
use App\Shared\Application\Bus\Query\QueryBus;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event; 

class ProductsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
 
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);

        $this->app->resolving(QueryBus::class, function (QueryBus $queryBus, $app) {

            $queryBus->registerHandler(GetAllProducts::class, fn($query) => $app->make(GetAllProductsHandler::class)->handle($query));

            $queryBus->registerHandler(GetProductById::class, fn(GetProductById $query) => $app->make(GetProductByIdHandler::class)->handle($query));
        });

        $this->app->resolving(CommandBus::class, function (CommandBus $commandBus, $app) {

            $commandBus->registerHandler(CreateProduct::class, fn(CreateProduct $command) => $app->make(CreateProductHandler::class)->handle($command));

            $commandBus->registerHandler(UpdateProduct::class, fn(UpdateProduct $command) => $app->make(UpdateProductHandler::class)->handle($command));

            $commandBus->registerHandler(DeleteProduct::class, fn(DeleteProduct $command) => $app->make(DeleteProductHandler::class)->handle($command));
        });
    }

    public function boot(): void
    {
        Event::listen(ProductCreated::class, SendProductCreatedEmailListener::class); 
    }
}


