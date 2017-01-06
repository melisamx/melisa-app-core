<?php namespace App\Core\Console\Commands;

use Melisa\core\LogicBusiness;
use App\Core\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

/**
 * Description of Generate
 *
 * @author Luis Josafat Heredia Contreras
 */
class RepositoriesGenerate extends GeneratorCommand
{
    use LogicBusiness;
    
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;
    
    /**
     * Create a new controller creator command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }
    
    public function init($connection = 'mysql')
    {
        
        $connection = \DB::connection($connection);
        $result = $connection->select('show tables');
        $database = $connection->getConfig('database');
        $prefix = $connection->getConfig('prefix');
        $tables = [];
        $flag = true;
        
        foreach($result as $i=>$table)
        {
            
            $tableName = ucfirst($table->{'Tables_in_' . $database});
            
            if( !empty($prefix)) {
                
                $tableName = substr($tableName, count($prefix));
                
            }
            
            $this->table = $tableName;
            $flag = $this->create($tableName . 'Repository');
            
            if( !$flag) {
                
                break;
                
            }
            
        }
        
        return $flag;
        
    }
    
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/repositories.stub';
    }
    
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Repositories';
    }
    
    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        
        parent::replaceNamespace($stub, $name);
        
        $stub = str_replace(
            'DummyClassModel', $this->table, $stub
        );
        $stub = str_replace(
            'DummyModelNameSpace', app()->getNamespace() . '\Models', $stub
        );
        return $this;
        
    }
    
}
