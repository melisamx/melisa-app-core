<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class Options extends Base
{
    
    protected $table = 'options';
    
    protected $fillable = [
        'key', 'name', 'isSubMenu', 'iconClassSmall', 'iconClassMedium',
        'iconClassLarge', 'text'
    ];
    
    public $timestamps = false;
    
}
