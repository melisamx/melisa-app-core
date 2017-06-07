<?php

namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class TranslationsLanguagesSeeder extends InstallSeeder
{
    
    public function run()
    {                
        $this->installTranslationLanguage('es', [
            'name'=>'Spanish',
        ]);        
    }
    
}
