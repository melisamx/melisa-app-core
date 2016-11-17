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
                'path'=>'/vendor/waves/waves.min.js',
                'extraParams'=>'androidAsset=inject',
            ],
            
        ]);
        
    }
    
}
