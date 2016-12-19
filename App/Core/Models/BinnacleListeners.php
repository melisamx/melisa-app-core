<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BinnacleListeners extends BaseUuid
{
    
    protected $table = 'binnacleListeners';
    
    protected $fillable = [
        'idBinnacleListenerStatus', 'idBinnacle', 'idListener', 'idIdentityCreated',
        'idIdentityUpdated'
    ];
    
    public function binnacle() {
        
        return $this->hasOne('App\Core\Models\Binnacle', 'id', 'idBinnacle');
        
    }
    
    public function listener() {
        
        return $this->hasOne('App\Core\Models\Listeners', 'id', 'idListener');
        
    }
    
}
