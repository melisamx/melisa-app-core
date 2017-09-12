<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
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
    
    public function identity()
    {        
        return $this->hasOne('App\Core\Models\Identities', 'id', 'idIdentityCreated');        
    }
    
}
