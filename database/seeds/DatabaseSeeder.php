<?php

use App\User;
use App\Model\Product;
use App\Model\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class, 20)->create();
        factory(Product::class, 50)->create();
        factory(Review::class, 100)->create();
    }
}
