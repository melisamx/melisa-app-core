<?php namespace App\Core\Logics\Binnacle;

use Melisa\core\LogicBusiness;
use App\Core\Repositories\BinnacleRepository;
use App\Core\Repositories\EventsRepository;
use App\Core\Logics\Identities\IdentitySession;
use Melisa\Laravel\Contracts\EventBinnacle;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class RegisterEvent
{
    use LogicBusiness;
    
    protected $binnacle;
    protected $events;
    protected $identitySession;

    public function __construct(
        BinnacleRepository $binnacle, 
        EventsRepository $events,
        IdentitySession $identitySession
    ) {
        
        $this->binnacle = $binnacle;
        $this->events = $events;
        $this->identitySession = $identitySession;
        
    }
    
    public function init(EventBinnacle &$e) {
        
        $event = $this->getEvent($e->getKey());
        
        if( $event === false) {
            
            return false;
            
        }
        
        if( is_null($event)) {
            
            $this->debug('The event {e} not is defined, ignore register in binnacle', [
                'e'=>$e->getKey()
            ]);
            return true;
            
        }
        
        $idCreator = $this->getCreator();
        
        if( !$idCreator) {
            
            return false;
            
        }
        
        $this->binnacle->beginTransaction();
        
        $idBinnacle = $this->createBinnacle($e, $event, $idCreator);
        
        if( !$idBinnacle) {
            
            return $this->binnacle->rollBack();
            
        }
        
        $this->binnacle->commit();
        
        \Redis::publish('new.job', json_encode([
            'urlRun'=>config('app.url') . 'events.php/api/v1/binnacle/process',
            'dateRun'=>time() * 1000,
            'postData'=>[
                'idBinnacle'=>$idBinnacle,
                'idCreator'=>$idCreator,
                'idEvent'=>$event->id,
                'event'=>$e->getKey()
            ],
        ]));
        
        return $idBinnacle;
        
    }
    
    public function createBinnacle(&$e, &$event, $idCreator) {
        
        $data = $e->getData();
        
        if( is_array($data)) {
            
            $data = json_encode($data);
            
        }
        
        return $this->binnacle->create([
            'idBinnacleStatus'=>1,
            'idEvent'=>$event->id,
            'idCreator'=>$idCreator,
            'isIndicted'=>false,
            'data'=>$data
        ]);
        
    }
    
    public function getCreator() {
        
        $user = request()->user();
        
        if( is_null($user)) {
            
            return $this->error('Session closed');
        }
        
        return $this->identitySession->init($user->id);
        
    }
    
    public function getEvent($key) {
        
        return $this->events->findBy('key', $key);
        
    }
    
}
