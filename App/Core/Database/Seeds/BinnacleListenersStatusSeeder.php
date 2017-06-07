<?php

namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class BinnacleListenersStatusSeeder extends InstallSeeder
{
    
    public function run()
    {                
        $this->updateOrCreate('App\Core\Models\BinnacleListenersStatus', [
            [
                'id'=>1,
                'name'=>'Nuevo'
            ],
            [
                'id'=>2,
                'name'=>'Procesando'
            ],
            [
                'id'=>3,
                'name'=>'Procesado'
            ],
            [
                'id'=>4,
                'name'=>'Cancelado'
            ],
            [
                'id'=>5,
                'name'=>'Procesado con errores'
            ],
        ]);        
    }
    
}
