<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Events extends BaseUuid
{
    
    protected $fillable = [
        'key', 'description', 'isSystem'
    ];
    
}
