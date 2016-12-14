<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

class Binnacle extends BaseUuid
{
    
    protected $table = 'binnacle';
    
    protected $fillable = [
        'id', 'idBinnacleStatus', 'idEvent', 'idIdentityCreated', 'createdAt', 
        'isProcessed', 'idIdentityUpdated', 'data', 'processedAt', 'updatedAt'
    ];
    
    public function event() {
        
        return $this->hasOne('App\Core\Models\Events', 'id', 'idEvent');
        
    }
    
}
