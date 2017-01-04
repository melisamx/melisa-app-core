<?php namespace App\Core\Logics\Identities;

use App\Core\Logics\Identities\IdentitySession;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Identities
{

    public function get($idUser = null)
    {
        static $class = null;
        
        if( !$class) {
            
            $class = app()->make(IdentitySession::class);
            
            
        }
        
        if( is_null($idUser)) {
            
            $idUser = request()->user()->id;
            
        }
        
        return $class->init($idUser);
        
    }
    
}
