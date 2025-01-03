<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ShopSuppliersSeeder;
use Database\Seeders\ShopCategoriesSeeder;
use Database\Seeders\ShopProductsSeeder;
use Database\Seeders\ShopProductImagesSeeder;
use Database\Seeders\ShopProductDiscountSeeder;
use Database\Seeders\ShopStoreSeeder;
use Database\Seeders\ShopUsersSeeder;
use Database\Seeders\ShopImportsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Dữ liệu mẫu về Products

        $this->call([ShopSuppliersSeeder::class]);
        $this->call([ShopCategoriesSeeder::class]);
        $this->call([ShopProductsSeeder::class]);
        $this->call([ShopProductImagesSeeder::class]);
        $this->call([ShopProductDiscountSeeder::class]);

        // Dữ liệu mẫu về Stores
        $this->call([ShopStoreSeeder::class]);
        $this->call([ShopImportsSeeder::class]);

        // Dữ liệu mẫu về Users
        $this->call([ShopUsersSeeder::class]);
    }
}
