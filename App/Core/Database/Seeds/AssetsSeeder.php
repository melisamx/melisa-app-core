<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\FirstOrCreate;

class AssetsSeeder extends Seeder
{
    
    use FirstOrCreate;
    
    public function run()
    {
        
        $this->call(AssetsTypeSeeder::class);
        
        $this->firstOrCreate('App\Core\Models\Assets', [
            [
                'id'=>'powerby.image',
                'idAssetType'=>4,
                'name'=>'Image PowerBy',
                'path'=>'/assets/images/powerby.png',
            ],
        ]);
        
        $this->call(AssetsSenchaSeeder::class);
        $this->call(AssetsCssSeeder::class);
        $this->call(AssetsJsSeeder::class);
        
    }
    
}
