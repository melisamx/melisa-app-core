<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BinnacleListenersErrors extends BaseUuid
{
    
    protected $table = 'binnacleListenersErrors';
    public $timestamps = false;
    protected $fillable = [
        'idBinnacleListener', 'error'
    ];    
    
    public function binnacleListener() {
        
        return $this->hasOne('App\Core\Models\BinnacleListeners', 'id', 'idBinnacleListener');
        
    }
    
}
