<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class Binnacle extends BaseUuid
{
    
    protected $table = 'binnacle';
    
    protected $fillable = [
        'id', 'idBinnacleStatus', 'idEvent', 'idCreator', 'createdAt', 'isIndicted',
        'data'
    ];
    
    public function event() {
        
        return $this->hasOne('App\Core\Models\Events', 'id', 'idEvent');
        
    }
    
}
