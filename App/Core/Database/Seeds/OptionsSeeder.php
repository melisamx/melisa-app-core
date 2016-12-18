<?php namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class OptionsSeeder extends InstallSeeder
{
    
    public function run()
    {
                
        $this->installOption('option.tbfill', [
            'name'=>'Sencha Component tbfill',
            'iconClassSmall'=>null,
            'iconClassMedium'=>null,
            'iconClassLarge'=>null,
        ]);
        
    }
    
}
