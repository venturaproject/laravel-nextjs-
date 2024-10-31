<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Products\Domain\Model\Product;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cargar datos desde el archivo JSON
        $jsonFilePath = database_path('data/products.json');
        $productData = json_decode(file_get_contents($jsonFilePath), true);

        // Crear instancia de Faker
        $faker = Faker::create();

        // Iterar sobre todos los productos del archivo JSON
        foreach ($productData as $product) {
            Product::create([
                'name' => $product['name'], 
                'description' => $product['description'], 
                'price' => $faker->randomFloat(2, 1, 100), 
                'date_add' => $faker->date(),
            ]);
        }
    }
}
