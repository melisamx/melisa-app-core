<?php

namespace App\Core\Events;

use Melisa\Laravel\Contracts\EventBinnacle;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ModuleAccessEvent implements EventBinnacle
{    
    protected $key;
    protected $data = null;

    public function __construct($keyEvent, $data = null)
    {        
        $this->key = $keyEvent;
        $this->data = $data;        
    }
    
    public function getData()
    {        
        return $this->data;        
    }
    
    public function getKey()
    {        
        return 'event.' . $this->key;        
    }
    
}
