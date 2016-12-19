<?php namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class AssetsTypeSeeder extends InstallSeeder
{
    
    public function run()
    {
        
        $this->updateOrCreate('App\Core\Models\AssetsType', [
            [
                'id'=>1,
                'name'=>'JavaScript',
                'key'=>'js',
            ],
            [
                'id'=>2,
                'name'=>'CSS',
                'key'=>'css',
            ],
            [
                'id'=>3,
                'name'=>'Image JPG',
                'key'=>'jpg',
            ],
            [
                'id'=>4,
                'name'=>'Image PNG',
                'key'=>'png',
            ],
        ]);
        
    }
    
}
