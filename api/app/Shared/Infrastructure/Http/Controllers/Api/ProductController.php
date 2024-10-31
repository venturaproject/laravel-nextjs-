<?php

namespace App\Shared\Infrastructure\Http\Controllers\Api;

use App\Products\Application\Commands\Create\CreateProduct;
use App\Products\Application\Commands\Update\UpdateProduct;
use App\Products\Application\Commands\Delete\DeleteProduct;
use App\Products\Application\Queries\GetAll\GetAllProducts;
use App\Products\Application\Queries\GetById\GetProductById;
use App\Products\Application\Commands\Create\CreateProductDTO; 
use App\Products\Application\Commands\Update\UpdateProductDTO; 
use App\Products\Infrastructure\Requests\CreateProductRequest; 
use App\Products\Infrastructure\Requests\UpdateProductRequest; 
use App\Shared\Application\Bus\Command\CommandBus;
use App\Shared\Application\Bus\Query\QueryBus;
use App\Shared\Infrastructure\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class ProductController extends Controller
{
    protected CommandBus $commandBus;
    protected QueryBus $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function index(): JsonResponse
    {
        $query = new GetAllProducts();
        $products = $this->queryBus->handle($query);
        
        return response()->json($products, Response::HTTP_OK); // 200 OK
    }

    public function store(CreateProductRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $createProductDTO = new CreateProductDTO(
            $validatedData['name'],
            $validatedData['description'] ?? '',
            $validatedData['price'],
            $validatedData['date_add'] ?? null
        );

        $command = new CreateProduct($createProductDTO);

        $product = $this->commandBus->handle($command);

        return response()->json($product, Response::HTTP_CREATED); // 201 Created
    }

    public function show(int $id): JsonResponse
    {
        $query = new GetProductById($id);
        $product = $this->queryBus->handle($query);

        return response()->json($product, Response::HTTP_OK); // 200 OK
    }
        
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $dto = new UpdateProductDTO(
            $request->validated()['name'],
            $request->validated()['description'],
            $request->validated()['price'],
            $request->validated()['date_add']
        );

        $command = new UpdateProduct($id, $dto);

        $product = $this->commandBus->handle($command);

        return response()->json($product, Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $command = new DeleteProduct($id);
        $this->commandBus->handle($command);

        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 No Content
    }
}



