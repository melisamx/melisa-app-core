<?php

namespace App\Core\Logics\Identities;

use App\Core\Logics\Identities\IdentitySession;
use Melisa\core\LogicBusiness;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Identities
{
    use LogicBusiness;

    public function get($idUser = null)
    {
        static $class = null;
        
        if( !$class) {
            $class = app()->make(IdentitySession::class);
        }
        
        if( is_null($idUser)) {            
            $user = $this->getUser();            
            if( !$user) {
                return false;
            }            
            $idUser = $user->id;            
        }
        
        return $class->init($idUser);        
    }
    
    public function getUser()
    {        
        $user = request()->user();
        
        if( is_null($user)) {
            return $this->error('User Unauthenticated');
        }
        
        return $user;        
    }
    
}
