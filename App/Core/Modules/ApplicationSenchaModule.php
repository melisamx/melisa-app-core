<?php namespace App\Core\Modules;

use App\Core\Logics\Modules\Outbuildings;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ApplicationSenchaModule extends Outbuildings
{
    
    public $layout = 'sencha.app';
    
    public function dataDictionary() {
        
        $baseUrl = basename(request()->getBaseUrl());
        
        return [
            'title'=>config('app.name'),
            'appId'=>'333333-3333-3333-333333333333',
            'urlManifest'=>'manifest/',
            'imagePoweredBy'=>$this->asset('powerby.image'),
            'bootstrap'=>$this->view('sencha.bootstrap'),
        ];
        
    }
    
}
