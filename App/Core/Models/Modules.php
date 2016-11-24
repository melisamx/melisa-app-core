<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class Modules extends Base
{
    
    protected $table = 'modules';
    
    protected $fillable = [
        'name', 'url', 'active', 'version', 'description', 'iconClassSmall', 
        'iconClassMedium', 'iconClassLarge', 'nameSpace'
    ];
    
    public $timestamps = false;
    
}
