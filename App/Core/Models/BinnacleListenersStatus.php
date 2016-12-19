<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BinnacleListenersStatus extends Base
{
    
    protected $table = 'binnacleListenersStatus';
    
    public $timestamps = false;
    
    public $incrementing = false;
    
    protected $fillable = [
        'id', 'name'
    ];
    
}
