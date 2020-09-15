<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatasourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('datasources')->delete();

        $datasources = [
            ['datasource_id' => 1, 'name' => 'CrystalSuiteDataSource', 'datasource_net_id' => 1],
            ['datasource_id' => 2, 'name' => 'XchainDataSource', 'datasource_net_id' => 3],
            ['datasource_id' => 3, 'name' => 'BlockscoutAPI', 'datasource_net_id' => 2],
            ['datasource_id' => 4, 'name' => 'InfuraProvider', 'datasource_net_id' => 5],
            ['datasource_id' => 5, 'name' => 'InfuraProviderRinkeby', 'datasource_net_id' => 6],
            ['datasource_id' => 6, 'name' => 'InfuraRopstenProvider', 'datasource_net_id' => 7],
            ['datasource_id' => 7, 'name' => 'OpenSeaImporter', 'datasource_net_id' => 5],
            ['datasource_id' => 8, 'name' => 'OpenSeaRinkebyDatasource', 'datasource_net_id' => 6],
            ['datasource_id' => 9, 'name' => 'BaobabProvider', 'datasource_net_id' => 8]
        ];

        DB::table('datasources')->insert($datasources);
    }
}
