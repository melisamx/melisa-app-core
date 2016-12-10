<?php namespace App\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Melisa\Laravel\Database\UpdateOrCreate;

class AssetsJsSeeder extends Seeder
{
    
    use UpdateOrCreate;
    
    public function run()
    {
        
        $this->UpdateOrCreate('App\Core\Models\Assets', [
            [
                'find'=>[
                    'id'=>'jquery',
                ],
                'values'=>[
                    'idAssetType'=>1,
                    'name'=>'jQuery',
                    'path'=>'/vendor/jquery/jquery-3.1.1.min.js',
                    'cdn'=>'//code.jquery.com/jquery-3.1.1.min.js',
                    'extraParams'=>'androidAsset=inject',
                ],
            ],
            [
                'find'=>[
                    'id'=>'waves',
                ],
                'values'=>[
                    'idAssetType'=>1,
                    'name'=>'Waves',
                    'path'=>'/vendor/waves/release/waves.min.js',
                    'extraParams'=>'androidAsset=inject',
                ]
            ],
            [
                'find'=>[
                    'id'=>'momentjs',
                ],
                'values'=>[
                    'idAssetType'=>1,
                    'name'=>'MomentJs',
                    'path'=>'/vendor/momentjs/release/moment.min.js'
                ]
            ],
            [
                'find'=>[
                    'id'=>'momentjs.locales',
                ],
                'values'=>[
                    'idAssetType'=>1,
                    'name'=>'MomentJs Local ES',
                    'path'=>'/vendor/momentjs/release/locales.min.js'
                ]
            ],
            [
                'find'=>[
                    'id'=>'momentjs.precise.range',
                ],
                'values'=>[
                    'idAssetType'=>1,
                    'name'=>'MomentJs Precise Range',
                    'path'=>'/vendor/momentjs/release/moment-precise-range.js'
                ]
            ],
            [
                'find'=>[
                    'id'=>'pdfjs',
                ],
                'values'=>[
                    'idAssetType'=>1,
                    'name'=>'PDF Reader in JavaScript',
                    'path'=>'/vendor/pdfjs/release/pdf.js'
                ]
            ],
            [
                'find'=>[
                    'id'=>'pdfjs.compatibility',
                ],
                'values'=>[
                    'idAssetType'=>1,
                    'name'=>'PDF Reader in JavaScript compatibilitiy',
                    'path'=>'/vendor/pdfjs/release/compatibility.js'
                ]
            ],
            [
                'find'=>[
                    'id'=>'melisa.pdfjs.canvas',
                ],
                'values'=>[
                    'idAssetType'=>1,
                    'name'=>'Viewer page PDF in canvas',
                    'path'=>'/vendor/melisa/release/render-canvas.js'
                ]
            ],
        ]);
        
    }
    
}
