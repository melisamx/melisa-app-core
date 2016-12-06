<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\UpdateOrCreate;

class BinnacleStatusSeeder extends Seeder
{
    use UpdateOrCreate;
    
    public function run()
    {
                
        $this->UpdateOrCreate('App\Core\Models\BinnacleStatus', [
            [
                'find'=>[
                    'id'=>1,
                ],
                'values'=>[
                    'name'=>'Nuevo',
                ]
            ],
            [
                'find'=>[
                    'id'=>2,
                ],
                'values'=>[
                    'name'=>'Procesando',
                ]
            ],
            [
                'find'=>[
                    'id'=>3,
                ],
                'values'=>[
                    'name'=>'Procesado',
                ]
            ],
            [
                'find'=>[
                    'id'=>4,
                ],
                'values'=>[
                    'name'=>'Cancelado',
                ]
            ],
            [
                'find'=>[
                    'id'=>5,
                ],
                'values'=>[
                    'name'=>'Procesado con errores',
                ]
            ],
        ]);
        
    }
    
}
