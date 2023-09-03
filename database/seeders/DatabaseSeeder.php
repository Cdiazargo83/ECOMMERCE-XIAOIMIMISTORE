<?php

namespace Database\Seeders;


use App\Models\Banner;
use App\Models\OrderPartner;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Storage::deleteDirectory('categories');
        Storage::deleteDirectory('subcategories');
        Storage::deleteDirectory('products');
        Storage::deleteDirectory('orders');
        Storage::deleteDirectory('orderspartner');
        Storage::deleteDirectory('banners');
        Storage::deleteDirectory('promocions');

        Storage::makeDirectory('categories');
        Storage::makeDirectory('subcategories');
        Storage::makeDirectory('products');
        Storage::makeDirectory('orders');
        Storage::makeDirectory('orderspartner');
        Storage::makeDirectory('banners');
        Storage::makeDirectory('promocions');



        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);

        $this->call(ProductSeeder::class);

        $this->call(ColorSeeder::class);
        $this->call(ColorProductSeeder::class);

        $this->call(SizeSeeder::class);

        $this->call(ColorSizeSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(PromocionSeeder::class);








    }
}
