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
        
        return [
            'title'=>config('app.name'),
            'appId'=>'333333-3333-3333-333333333333',
            'urlManifest'=>'manifest/',
            'imagePoweredBy'=>$this->asset('powerby.image', true),
            'bootstrap'=>$this->view('sencha.bootstrap'),
        ];
        
    }
    
}
