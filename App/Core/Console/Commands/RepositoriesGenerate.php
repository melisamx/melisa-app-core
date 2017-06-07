<?php

namespace App\Core\Console\Commands;

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
     * The table in process
     */
    protected $table;
    
    /**
     * The tables in database connection
     */
    protected $tables;
    
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
    
    public function init($group = 'mysql')
    {        
        $connection = $this->getConnection($group);
        $tables = $this->getTables();
        
        if( empty($tables)) {
            
            $this->info('Empty database');
            return true;
            
        }
        
        return $this->createFiles($this->getTablesGenerate());        
    }
    
    public function createFiles($tables)
    {        
        foreach($tables as $table) {
            
            $flag = $this->createFileRepositorie($table);
            
            if( !$flag) {
                return $this->error('Imposible create file Class repositorie {t}', [
                    't'=>$table
                ]);
            }
            
        }
        
        return true;        
    }
    
    public function createFileRepositorie($table)
    {        
        $this->table = $table;
        $prefix = $this->connection->getConfig('prefix');
        
        if( !empty($prefix) && substr($table, 0, strlen($prefix)) == $prefix) {            
            $table = substr($table, strlen($prefix));            
        }
        
        return $this->create(ucfirst($table) . 'Repository');        
    }
    
    public function getTablesGenerate()
    {        
        $onlyTables = config('commands.generate.only');
        
        if( is_null($onlyTables)) {            
            return $this->tables;            
        }
            
        return array_filter($this->tables, function($table) use ($onlyTables) {            
            return in_array($table, $onlyTables, true);
        });        
    }
    
    public function getConnection($group)
    {        
        $this->connectionName = $group;        
        return $this->connection = \DB::connection($group);        
    }
    
    public function getTables()
    {        
        $result = $this->connection->select('show tables');
        $database = $this->connection->getConfig('database');
        $tables = [];        
        foreach($result as $i=>$table) {            
            $tables []= $table->{'Tables_in_' . $database};            
        }
        
        return $this->tables = $tables;        
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
        $prefix = $this->connection->getConfig('prefix');        
        if( !empty($prefix) && substr($this->table, 0, strlen($prefix)) == $prefix) {
            $this->table = substr($this->table, strlen($prefix));
        } else {
            $this->table = ucfirst($this->table);
        }
        
        $stub = str_replace(
            'DummyClassModel', $this->table, $stub
        );
        $stub = str_replace(
            'DummyModelNameSpace', app()->getNamespace() . '\Models', $stub
        );
        return $this;        
    }
    
}
