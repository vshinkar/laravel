<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\User::class, 50)->create()->each(function ($u) {
            $u->products()->save(factory(App\Product::class)->make());
        });
    }

}
