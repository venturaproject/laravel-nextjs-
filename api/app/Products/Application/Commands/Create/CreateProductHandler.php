<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Create;

use App\Products\Application\Commands\Create\CreateProduct;
use App\Products\Domain\Events\ProductCreated;
use App\Products\Domain\Model\Product;
use App\Products\Domain\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\Event;

class CreateProductHandler
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(CreateProduct $command): Product
    {

        $dto = $command->dto;


        $product = new Product();
        $product->fill([
            'name' => $dto->name,
            'description' => $dto->description,
            'price' => $dto->price,
            'date_add' => $dto->date_add,
        ]);

        $this->productRepository->save($product);

        Event::dispatch(new ProductCreated($product));

        return $product;
    }
}
