<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class TranslationsLanguages extends Base
{
    
    protected $table = 'translationsLanguages';
    
    protected $fillable = [
        'id', 'name'
    ];
    
    public $timestamps = false;
    
}
