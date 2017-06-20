<?php

namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class ProfilesSeeder extends InstallSeeder
{
    
    public function run()
    {                
        $this->installProfile('system', [
            'name'=>'System',
            'isSystem'=>true,
            'icon'=>'fa fa-superpowers',
        ]);        
        $this->installProfile('personal', [
            'name'=>'Personal',
            'isSystem'=>false,
            'icon'=>'fa fa-user',
        ]);        
    }
    
}
