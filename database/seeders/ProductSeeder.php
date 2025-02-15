<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Assicuriamoci che ci siano categorie disponibili
        if (Category::count() == 0) {
            Category::create(['name' => 'Categoria Default']);
        }

        // Creiamo 20 prodotti di test
        Product::factory(20)->create();
    }
}
