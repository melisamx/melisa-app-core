<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class BinnacleStatus extends Base
{
    
    protected $table = 'binnacleStatus';
    
    public $timestamps = false;
    
    public $incrementing = false;
    
    protected $fillable = [
        'id', 'name'
    ];
    
}
