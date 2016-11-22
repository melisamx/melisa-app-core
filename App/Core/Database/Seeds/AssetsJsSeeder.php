<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\FirstOrCreate;

class AssetsJsSeeder extends Seeder
{
    
    use FirstOrCreate;
    
    public function run()
    {
        
        $this->firstOrCreate('App\Core\Models\Assets', [
            [
                'id'=>'jquery',
                'idAssetType'=>1,
                'name'=>'jQuery',
                'path'=>'/vendor/jquery/jquery-3.1.1.min.js',
                'cdn'=>'//code.jquery.com/jquery-3.1.1.min.js',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'waves',
                'idAssetType'=>1,
                'name'=>'Waves',
                'path'=>'/vendor/waves/release/waves.min.js',
                'extraParams'=>'androidAsset=inject',
            ],
            [
                'id'=>'momentjs',
                'idAssetType'=>1,
                'name'=>'MomentJs',
                'path'=>'/vendor/momentjs/release/moment.min.js'
            ],
            [
                'id'=>'momentjs.locales',
                'idAssetType'=>1,
                'name'=>'MomentJs Local ES',
                'path'=>'/vendor/momentjs/release/locales.min.js'
            ],
            [
                'id'=>'momentjs.precise.range',
                'idAssetType'=>1,
                'name'=>'MomentJs Precise Range',
                'path'=>'/vendor/momentjs/release/moment-precise-range.js'
            ],
            
        ]);
        
    }
    
}
