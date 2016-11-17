<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\FirstOrCreate;

class AssetsTypeSeeder extends Seeder
{
    
    use FirstOrCreate;
    
    public function run()
    {
        
        $this->firstOrCreate('App\Core\Models\AssetsType', [
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
