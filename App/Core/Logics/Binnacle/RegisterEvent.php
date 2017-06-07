<?php

namespace App\Core\Logics\Binnacle;

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
    )
    {        
        $this->binnacle = $binnacle;
        $this->events = $events;
        $this->identitySession = $identitySession;        
    }
    
    public function init(EventBinnacle &$e)
    {        
        $events = $this->getEvents($e->getKey());
        
        if( $events === false) {            
            return false;            
        }
        
        if( !count($events)) {            
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
        
        $idBinnacles = $this->createBinnacle($e, $events, $idCreator);
        
        if( !$idBinnacles) {            
            return $this->binnacle->rollBack();            
        }
        
        $this->binnacle->commit();        
        $this->publishEvent($idBinnacles);        
        return $idBinnacles;        
    }
    
    public function publishEvent(&$idBinnacles)
    {        
        $appUrl = config('app.url');
        
        if( !melisa('string')->endsWith($appUrl, '/')) {            
            $appUrl .= '/';            
        }
        
        foreach($idBinnacles as $idBinnacle) {            
            \Redis::publish('new.job', json_encode([
                'urlRun'=>$appUrl . 'events.php/api/v1/binnacle/process',
                'dateRun'=>time() * 1000,
                'postData'=>[
                    'idBinnacle'=>$idBinnacle,
                ],
            ]));            
        }        
    }
    
    public function createBinnacle(&$e, &$events, $idCreator)
    {        
        $data = $e->getData();
        
        if( is_array($data)) {            
            $data = json_encode($data);            
        }
        
        $ids = [];
        
        foreach($events as $event) {            
            $result = $this->binnacle->create([
                'idBinnacleStatus'=>1,
                'idEvent'=>$event->id,
                'idIdentityCreated'=>$idCreator,
                'isProcessed'=>false,
                'data'=>$data
            ]);
            
            if( !$result) {                
                return false;                
            }            
            
            $ids []= $result;            
        }
        
        return $ids;        
    }
    
    public function getCreator()
    {        
        $user = request()->user();
        
        if( is_null($user)) {            
            return $this->error('Session closed');
        }
        
        return $this->identitySession->init($user->id);        
    }
    
    public function getEvents($key)
    {        
        $wheres = [
            [
                'key', $key
            ]
        ];
        
        $keysPart = explode('.', $key);
        
        foreach($keysPart as $i => $keyPart) {            
            array_pop($keysPart);            
            $wheres []= [
                'key', implode('.', $keysPart) . '.*'
            ];            
        }
        
        array_pop($wheres);        
        return $this->events->findWhere($wheres, ['*'], true);        
    }
    
}
