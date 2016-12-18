<?php namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class AssetsSeeder extends InstallSeeder
{
    
    public function run()
    {
        
        $this->call(AssetsTypeSeeder::class);
        
        $this->installAssetImage('powerby.image', [
            'name'=>'Image PowerBy',
            'path'=>'/assets/images/powerby.png'
        ]);
        
        $this->call(AssetsSenchaSeeder::class);
        $this->call(AssetsCssSeeder::class);
        $this->call(AssetsJsSeeder::class);
        
    }
    
}
