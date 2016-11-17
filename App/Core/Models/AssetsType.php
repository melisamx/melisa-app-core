<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

class AssetsType extends Base
{
    
    protected $table = 'assetsTypes';
    
    public $timestamps = false;
    
    public $incrementing = false;
    
    protected $fillable = [
        'id', 'name', 'key'
    ];
    
}
