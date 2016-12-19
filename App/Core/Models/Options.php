<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Options extends Base
{
    
    protected $table = 'options';
    
    protected $fillable = [
        'key', 'name', 'isSubMenu', 'iconClassSmall', 'iconClassMedium',
        'iconClassLarge', 'text'
    ];
    
    public $timestamps = false;
    
}
