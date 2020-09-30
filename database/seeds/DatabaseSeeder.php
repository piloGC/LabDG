<?php

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
        $this->call(CategoriaSeeder::class);
        $this->call(EncargadoSeeder::class);
        $this->call(EnCatalogoSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
