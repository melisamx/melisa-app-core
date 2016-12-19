<?php namespace App\Core\Logics\Modules;

use Melisa\core\LogicBusiness;
use App\Core\Events\ModuleAccessEvent;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Outbuildings
{
    use LogicBusiness;
    
    public $debug = true;
    public $event = null;
    
    public function render() {
        
        $this->debug = config('app.env') === 'local' ? true : false;
        
        $dataDictionary = $this->dataDictionary($this);
        
        if( isset($this->layout) && is_string($this->layout)) {
            
            return view($this->layout, $dataDictionary);
            
        }
        
        if( is_null($this->event)) {
            
            return $dataDictionary;
            
        }
        
        if( !$this->proccessEvent()) {
            
            return [
                'success'=>false,
                'errors'=>melisa('msg')->get()
            ];
            
        }
        
        return $dataDictionary;
        
    }
    
    public function proccessEvent() {
        
        $result = event(new ModuleAccessEvent($this->event));
        
        if( in_array(false, $result)) {
            
            return false;
            
        }
        
        return true;
        
    }
    
    public function dataDictionary() {
        
        
    }
            
    function __call($p, $arguments) {
        
        if( isset($this->{$p})) {
            
            return call_user_func_array([$this->{$p}, 'get'], $arguments);
            
        }
        
        try {
            
            $class = app()->make(__NAMESPACE__ . '\Outbuildings\\' . ucfirst($p));
            
        } catch (\ReflectionException $ex) {
            
            $class = $this->error('No support function: {m}', [
                'm'=>$ex->getMessage()
            ]);
            
        }
        
        if( !$class) {
            
            return null;
            
        }
        
        if(method_exists($class, 'setOutbuildings')) {
            
            $class->setOutbuildings($this);
            
        }        
        
        $this->{$p} = $class;
        
        return call_user_func_array([$this->{$p}, 'get'], $arguments);
        
    }
    
}
