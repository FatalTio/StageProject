<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        DB::table('nets')->delete();

        $nets = [
            ['net_id' => 1, 'name' => 'Bitcoin_mainnet', 'nets_blockchain_id' => 1],
            ['net_id' => 2, 'name' => 'Bitcoin_testnet', 'nets_blockchain_id' => 1],
            ['net_id' => 3, 'name' => 'Counterparty_mainnet', 'nets_blockchain_id' => 3],
            ['net_id' => 4, 'name' => 'Counterpart_testnet', 'nets_blockchain_id' => 3],
            ['net_id' => 5, 'name' => 'Ethereum_mainnet', 'nets_blockchain_id' => 2],
            ['net_id' => 6, 'name' => 'Rinkeby', 'nets_blockchain_id' => 2],
            ['net_id' => 7, 'name' => 'Ropsten', 'nets_blockchain_id' => 2],
            ['net_id' => 8, 'name' => 'Klaytn_mainnet', 'nets_blockchain_id' => 4]
        ];

        DB::table('nets')->insert($nets);
    }
}
