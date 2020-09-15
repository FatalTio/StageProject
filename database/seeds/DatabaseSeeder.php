<?php

// use Database\Seeds\BlockchainTableSeeder;
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
        $this->call(BlockchainTableSeeder::class);
        $this->call(DatasourceTableSeeder::class);
        $this->call(NetTableSeeder::class);
    }
}
