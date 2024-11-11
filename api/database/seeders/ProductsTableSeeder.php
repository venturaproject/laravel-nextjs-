<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Products\Domain\Model\Product;
use Illuminate\Support\Facades\Http;

class ProductsTableSeeder extends Seeder
{
    private const API_URL = 'https://dummyjson.com/products';
    private const DEFAULT_PRODUCT_COUNT = 30;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Realiza la petición a la API para obtener los productos
            $response = Http::get(self::API_URL);
            $productsData = $response->json()['products'] ?? [];
        } catch (\Exception $e) {
            throw new \RuntimeException('Error al conectar con la API de productos: ' . $e->getMessage());
        }

        // Limita la cantidad de productos a insertar
        $productsToCreate = array_slice($productsData, 0, self::DEFAULT_PRODUCT_COUNT);

        foreach ($productsToCreate as $data) {
            Product::create([
                'name' => $data['title'],
                'description' => $data['description'] ?? null,
                'price' => $data['price'],
                'date_add' => now(),
            ]);
        }
    }
}
