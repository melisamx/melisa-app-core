<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Core\Models\TranslationsLanguages;

class TranslationsLanguagesSeeder extends Seeder
{
    
    public function run()
    {
                
        TranslationsLanguages::updateOrCreate([
            'id'=>'es'
        ], [
            'name'=>'Spanish',
        ]);
        
    }
    
}
