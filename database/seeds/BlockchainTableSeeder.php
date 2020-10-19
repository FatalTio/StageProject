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
    public function run()
    {
        DB::table('blockchains')->delete();

        $blockchains = [
            ['blockchain_id' => 1 ,'name' => 'Bitcoin'],
            ['blockchain_id' => 2 ,'name' => 'Ethereum'],
            ['blockchain_id' => 3 ,'name' => 'Counterparty'],
            ['blockchain_id' => 4 ,'name' => 'Klaytn']
        ];

        DB::table('blockchains')->insert($blockchains);
    }
}
