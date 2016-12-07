<?php namespace App\Core\Logics\Modules;

use App\Core\Repositories\ModulesRepository;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Run
{
    
    protected $modules;
    private $user = 'robot.schedule@melisa.mx';
    private $pass = 'sWeld#s02';
    private $error;

    public function __construct(ModulesRepository $modules) {
        
        $this->modules = $modules;
        
    }
    
    public function init($idModule, $data) {
        
        $module = $this->modules->findOrFail($idModule);
        
        if( !$module) {
            
            return false;
            
        }
        
        if( !$module->active) {
            
            return $this->error('Module {m} is not active, ignore request', [
                'm'=>$module->name
            ]);
            
        }
        
        return $this->createRequest($module->url, $data);        
        
    }
    
    public function setError($error) {
        
        $this->error = $error;
        
    }
    
    public function getError() {
        
        return $this->error;
        
    }
    
    public function createRequest($url, &$data) {
        
        $client = new \GuzzleHttp\Client();
        
        $data = json_decode($data);
        $urlServer = config('app.url');        
        $flag = true;
        
        try {
            
            $result = $client->request('POST', $urlServer . $url, [
                'auth'=>[ $this->user, $this->pass ],
                'form_params'=>$data
            ]);
            
        } catch (ClientException $ex) {
            
            $response = $ex->getResponse();
            $contents = $response->getBody()->getContents();
            $this->setError($contents);
            $flag = false;
            
        } catch (ConnectException $ex) {
            
            $flag = false;
        }
        
        return $flag;
        
    }
    
}
