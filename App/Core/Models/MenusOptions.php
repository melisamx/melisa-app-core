<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class MenusOptions extends Base
{
    
    protected $table = 'menusOptions';
    
    protected $fillable = [
        'idMenu', 'idOption', 'idOptionParent', 'order'
    ];
    
    public $timestamps = false;
    
    public function translation($key = 'es') {
        
        return $this->hasMany('App\Core\Models\Translations', 'key', 'id')
            ->where('translatations.idTranslationLanguaje', '=', $key);
        
    }
    
}
