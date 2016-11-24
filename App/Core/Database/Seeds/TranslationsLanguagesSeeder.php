<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\IdSeeder;
use App\Core\Models\TranslationsLanguages;

class TranslationsLanguagesSeeder extends Seeder
{    
    use IdSeeder;
    
    public function run()
    {
                
        TranslationsLanguages::updateOrCreate([
            'id'=>'es'
        ], [
            'name'=>'Spanish',
        ]);
        
    }
    
}
