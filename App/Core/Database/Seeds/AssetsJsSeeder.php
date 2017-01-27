<?php namespace App\Core\Database\Seeds;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 * 
 * @author Luis Josafat Heredia Contreras
 */
class AssetsJsSeeder extends InstallSeeder
{
    
    public function run()
    {
        
        $this->installAssetJs('jquery', [
            'name'=>'jQuery',
            'path'=>'/vendor/jquery/jquery-3.1.1.min.js',
            'cdn'=>'//code.jquery.com/jquery-3.1.1.min.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        $this->installAssetJs('waves', [
            'name'=>'Waves',
            'path'=>'/vendor/waves/release/waves.min.js',
            'extraParams'=>'androidAsset=inject'
        ]);
        
        
        $this->installAssetJs('momentjs', [
            'name'=>'MomentJs',
            'path'=>'/vendor/momentjs/release/moment.min.js'
        ]);
        
        $this->installAssetJs('momentjs.locales', [
            'name'=>'MomentJs Local ES',
            'path'=>'/vendor/momentjs/release/locales.min.js'
        ]);
        
        $this->installAssetJs('momentjs.precise.range', [
            'name'=>'MomentJs Precise Range',
            'path'=>'/vendor/momentjs/release/moment-precise-range.js'
        ]);        
        
        $this->installAssetJs('pdfjs', [
            'name'=>'PDF Reader in JavaScript',
            'path'=>'/vendor/pdfjs/release/pdf.js'
        ]);        
        
        $this->installAssetJs('pdfjs.compatibility', [
            'name'=>'PDF Reader in JavaScript compatibilitiy',
            'path'=>'/vendor/pdfjs/release/compatibility.js'
        ]);
        
        $this->installAssetJs('melisa.pdfjs.canvas', [
            'name'=>'Viewer page PDF in canvas',
            'path'=>'/vendor/melisa/release/render-canvas.js'
        ]);
        
        $this->installAssetJs('chartjs', [
            'name'=>'Simple HTML5 Charts using the <canvas> tag',
            'path'=>'/vendor/chartjs/release/Chart.min.js'
        ]);
        
        $this->installAssetJs('chartjs.bundle', [
            'name'=>'Simple HTML5 Charts using the <canvas> tag (version bundle)',
            'path'=>'/vendor/chartjs/release/Chart.bundle.min.js'
        ]);
        
    }
    
}
