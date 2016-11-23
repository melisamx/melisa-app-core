<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class MenusOptions extends Base
{
    
    protected $table = 'menusOptions';
    
    protected $fillable = [
        'idMenu', 'idOption', 'idOptionParent', 'order'
    ];
    
    public $timestamps = false;
    
}
