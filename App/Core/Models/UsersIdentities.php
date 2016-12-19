<?php namespace App\Core\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UsersIdentities extends BaseUuid
{
    
    protected $table = 'usersIdentities';
    
    protected $fillable = [
        'idUser', 'idIdentity',
    ];
    
    protected $hidden = [];
    
    public $timestamps = false;
    
    public static function bootNoUpdateCreate()
    {
        
    }
    
    public function identity()
    {
        
        return $this->hasOne('App\Core\Models\Identities', 'id', 'idIdentity');
        
    }
    
}
