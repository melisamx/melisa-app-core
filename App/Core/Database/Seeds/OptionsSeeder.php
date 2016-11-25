<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Core\Models\Options;

class OptionsSeeder extends Seeder
{
    
    public function run()
    {
                
        Options::updateOrCreate([
            'key'=>'option.tbfill',
        ], [
            'name'=>'Sencha Component tbfill',
            'iconClassSmall'=>null,
            'iconClassMedium'=>null,
            'iconClassLarge'=>null,
        ]);
        
    }
    
}
