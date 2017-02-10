<?php namespace App\Core\Models;

use Melisa\Laravel\Models\UuidForKey;
use Melisa\Laravel\Models\NoUpdateCreate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class User extends Authenticatable
{
    use Notifiable, UuidForKey, NoUpdateCreate;
    
    /* necesary orm autenticable and no extend melisa model base */
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    
    public $incrementing = FALSE;

    protected $fillable = [
        'name', 'email', 'password', 'changePassword',
    ];

    protected $hidden = [
        'password', 'rememberToken',
    ];
    
    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    public function setRememberToken($value)
    {
        $this->rememberToken = $value;
    }

    public function getRememberTokenName()
    {
        return 'rememberToken';
    }
    
    public function usersIdentities()
    {
        
        return $this->hasMany('App\Core\Models\UsersIdentities', 'idUser');
        
    }
    
    public function avatars()
    {
        return $this->hasMany('App\Security\Models\UsersAvatars', 'idUser');
    }
    
}
