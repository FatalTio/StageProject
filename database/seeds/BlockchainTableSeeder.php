<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlockchainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        DB::table('blockchains')->delete();

        $blockchains = [
            ['id' => 1 ,'name' => 'Bitcoin'],
            ['id' => 2 ,'name' => 'Ethereum'],
            ['id' => 3 ,'name' => 'Counterparty'],
            ['id' => 4 ,'name' => 'Klaytn']
        ];

        DB::table('blockchains')->insert($blockchains);
    }
}
