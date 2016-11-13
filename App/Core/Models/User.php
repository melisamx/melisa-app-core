<?php namespace App\Core\Models;

use Melisa\Laravel\Models\UuidForKey;
use Melisa\Laravel\Models\NoUpdateCreate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, UuidForKey, NoUpdateCreate;
    
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    public $incrementing = FALSE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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
    
}
