<?php namespace App\Core\Logics\Identities;

use \App\Core\Repositories\IdentitiesRepository;
use \Melisa\core\LogicBusiness;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddIdentity
{
    use LogicBusiness;
    
    protected $repo;
    
    public function __construct(IdentitiesRepository $repo) {
        
        $this->repo = $repo;
        
    }
    
    public function init(array $input) {
        
        $this->repo->beginTransaction();
        
        $input ['idProfile']= 1;
        
        $idIdentity = $this->repo->create($input);
        
        if( !$idIdentity) {
            
            return $this->error('Imposible create identity');
            
        }
        
        $this->repo->commit();
        
        return $idIdentity;
    }
    
}
