<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Modules extends Base
{
    
    protected $table = 'modules';
    
    protected $fillable = [
        'name', 'url', 'active', 'version', 'description', 'iconClassSmall', 
        'iconClassMedium', 'iconClassLarge', 'nameSpace', 'route'
    ];
    
    public $timestamps = false;
    
}
