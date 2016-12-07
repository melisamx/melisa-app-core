<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class Listeners extends Base
{
    
    protected $fillable = [
        'idEvent', 'idModule', 'active'
    ];
    
}
