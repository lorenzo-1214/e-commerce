<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Smartphone Samsung Galaxy S21',
                'description' => 'Uno smartphone potente con fotocamera avanzata e batteria di lunga durata.',
                'price' => 799.99,
                'stock' => 10,
                'category_id' => 1, // Elettronica
                'image' => 'products/samsung.jpeg', // Immagine locale
            ],
            [
                'name' => 'Smart TV LG 55"',
                'description' => 'Smart TV 4K Ultra HD con supporto HDR10 e app integrate.',
                'price' => 499.99,
                'stock' => 5,
                'category_id' => 1, // Elettronica
                'image' => 'products/smrttv.jpeg',
            ],
            [
                'name' => 'Giacca Invernale North Face',
                'description' => 'Giacca calda e resistente per affrontare le temperature più fredde.',
                'price' => 199.99,
                'stock' => 20,
                'category_id' => 2, // Abbigliamento
                'image' => 'products/giacca.jpeg',
            ],
            [
                'name' => 'Scarpe Nike Air Max',
                'description' => 'Scarpe sportive con design moderno e ammortizzazione confortevole.',
                'price' => 129.99,
                'stock' => 15,
                'category_id' => 2, // Abbigliamento
                'image' => 'products/airmax.jpeg',
            ],
            [
                'name' => 'Set di Pentole Acciaio Inox',
                'description' => 'Set di pentole di alta qualità per cucinare in modo efficiente.',
                'price' => 89.99,
                'stock' => 25,
                'category_id' => 3, // Casa
                'image' => 'products/pentole.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'category_id' => $product['category_id'],
                'image' => $product['image'],
            ]);
        }
    }
}
