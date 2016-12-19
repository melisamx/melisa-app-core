<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Profiles extends Base
{
    
    protected $fillable = [
        'name', 'key', 'isSystem', 'active', 'icon'
    ];
    
}
