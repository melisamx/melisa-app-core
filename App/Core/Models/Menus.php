<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class Menus extends Base
{
    
    protected $table = 'menus';
    
    protected $fillable = [
        'key', 'name'
    ];
    
    public $timestamps = false;
    
}
