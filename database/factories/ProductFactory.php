<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $name = $this->faker->sentence(2);
        $sku = $this->faker->unique()->word;


        $atocong = $this->faker->sentence(2);
        $jockeypz = $this->faker->sentence(2);
        $megaplz = $this->faker->sentence(2);
        $huaylas = $this->faker->sentence(2);
        $puruchu = $this->faker->sentence(2);


        $subcategory = Subcategory::inRandomOrder()->first();
        $category = $subcategory->category;
        $brand = $category->brands->random();


        $quantity = $subcategory->color ? null : 2;
        $quantity_partner = $subcategory->color ? null : 2;
        $stock_flex = $subcategory->color ? null : 2;

        return [
            'name' => $name,
            'sku' => $sku,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(),

            'atocong' => $atocong,
            'jockeypz' => $jockeypz,
            'megaplz' => $megaplz,
            'huaylas' => $huaylas,
            'puruchu' => $puruchu,

            'bodega' => $this->faker->randomElement([2]),

            'price' => $this->faker->randomElement([19.99, 49.99, 99.99]),
            'price_tachado' => $this->faker->randomElement([100.99, 149.99, 199.99]),
            'price_partner' => $this->faker->randomElement([10.99, 9.99, 15.99]),
            'subcategory_id' => $subcategory->id,
            'brand_id' => $brand->id,
            'quantity' => $quantity,
            'quantity_partner' => $quantity_partner,
            'stock_flex' => $stock_flex,
            'status' => 2,
            'destacado' => 1,
        ];
    }
}
