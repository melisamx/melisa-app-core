<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class People extends BaseUuid
{
    
    protected $fillable = [
        'name', 'firstName', 'lastName', 'firstName', 'nickname', 'gender',
        'birthday'
    ];
    
    protected $dateFormat = 'Y-m-d';
    protected $dates = [ 'birthday' ];
    
    public function setBirthdayAttribute($value)
    {
        
        return $this->birthday = $value ? $value : NULL;
        
    }
    
}
