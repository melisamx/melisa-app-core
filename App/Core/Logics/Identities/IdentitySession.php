<?php namespace App\Core\Logics\Identities;

use App\Core\Repositories\IdentitiesRepository;
use Melisa\core\LogicBusiness;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class IdentitySession
{
    use LogicBusiness;
    
    protected $identities;

    public function __construct(IdentitiesRepository $identities) {
        
        $this->identities = $identities;
        
    }
    
    public function init($idUser) {
        
        $idIdentity = session('idIdentity');
        
        if( $idIdentity) {
            
            return $idIdentity;
            
        }
        
        $defaultIdentity = $this->getSearchDefault($idUser);
        
        if( !$defaultIdentity) {
            
            return false;
            
        }
        
        $this->saveInSession($defaultIdentity->id);
        
        return $defaultIdentity->id;
        
    }
    
    public function saveInSession($idIdentity) {
        
        session([
            'idIdentity'=>$idIdentity
        ]);
        
    }
    
    public function getSearchDefault($idUser) {
        
        return app()
            ->make('App\Core\Logics\Identities\SearchDefault')
            ->init($idUser);
        
    }
    
}
