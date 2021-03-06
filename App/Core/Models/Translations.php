<?php namespace App\Core\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Translations extends Base
{
    
    protected $table = 'translations';
    
    protected $fillable = [
        'idTranslationLanguage', 'key', 'text'
    ];
    
    public $timestamps = false;
    
}
