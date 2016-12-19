<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Listeners extends Base
{
    
    protected $fillable = [
        'idEvent', 'idModule', 'active'
    ];
    
}
