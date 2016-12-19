<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AssetsType extends Base
{
    
    protected $table = 'assetsTypes';
    
    public $timestamps = false;
    
    public $incrementing = false;
    
    protected $fillable = [
        'id', 'name', 'key'
    ];
    
}
