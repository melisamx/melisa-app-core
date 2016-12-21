<?php namespace App\Core\Logics\Modules;

use App\Core\Repositories\ModulesRepository;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Run
{
    
    protected $modules;
    private $user;
    private $pass;
    private $error;

    public function __construct(ModulesRepository $modules) {
        
        $this->modules = $modules;
        $this->user = env('RUN_MODULE_USER', 'youruser');
        $this->pass = env('RUN_MODULE_PASS', 'yourpass');
        
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
        $appUrl = config('app.url');
        
        if( !melisa('string')->endsWith($appUrl, '/')) {
            
            $appUrl .= '/';
            
        }
        
        /* request external */
        if( melisa('string')->startsWith($url, '//')) {
            
            $appUrl = '';
            
        } else if( melisa('string')->startsWith($url, '/')) {
            
            $url = substr($url, 1);
            
        }
        
        $flag = true;
        
        $this->info('run module {s}{a} with the user {u}', [
            's'=>$appUrl,
            'a'=>$url,
            'u'=>$this->user
        ]);
        
        try {
            
            $result = $client->request('POST', $appUrl . $url, [
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
