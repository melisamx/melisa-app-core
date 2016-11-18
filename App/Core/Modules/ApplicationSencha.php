<?php namespace App\Core\Modules;

use App\Core\Logics\Modules\LoadModule;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ApplicationSencha extends LoadModule
{
    
    public $layout = 'sencha.app';
    
    public function dataDictionary() {
        
        $baseUrl = basename(request()->getBaseUrl());
        
        return [
            'title'=>config('app.name'),
            'appId'=>'fe11c8b6-be17-44a1-bf5d-a36cc4a5f95d',
            'urlManifest'=>"/$baseUrl/manifest/",
            'imagePoweredBy'=>$this->getAsset('powerby.image'),
            'bootstrap'=>$this->getView('sencha.bootstrap'),
        ];
        
    }
    
}
