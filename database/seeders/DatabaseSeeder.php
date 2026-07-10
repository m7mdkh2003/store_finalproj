<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        $electronics = Category::firstOrCreate([
            'name' => 'Electronics',
        ], [
            'description' => 'Electronic devices and accessories.',
        ]);

        $books = Category::firstOrCreate([
            'name' => 'Books',
        ], [
            'description' => 'Educational and general books.',
        ]);

        $clothes = Category::firstOrCreate([
            'name' => 'Clothes',
        ], [
            'description' => 'Clothing and fashion products.',
        ]);

        Product::firstOrCreate([
            'name' => 'Laptop',
        ], [
            'category_id' => $electronics->id,
            'description' => 'High performance laptop for work and study.',
            'price' => 750,
            'stock' => 10,
        ]);

        Product::firstOrCreate([
            'name' => 'Smartphone',
        ], [
            'category_id' => $electronics->id,
            'description' => 'Modern smartphone with excellent features.',
            'price' => 500,
            'stock' => 15,
        ]);

        Product::firstOrCreate([
            'name' => 'Laravel Book',
        ], [
            'category_id' => $books->id,
            'description' => 'A practical book for learning Laravel.',
            'price' => 35,
            'stock' => 20,
        ]);

        Product::firstOrCreate([
            'name' => 'T-Shirt',
        ], [
            'category_id' => $clothes->id,
            'description' => 'Comfortable cotton t-shirt.',
            'price' => 20,
            'stock' => 30,
        ]);
    }
}