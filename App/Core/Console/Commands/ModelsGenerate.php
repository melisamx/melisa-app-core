<?php namespace App\Core\Console\Commands;

use Melisa\core\LogicBusiness;
use App\Core\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

/**
 * Description of Generate
 *
 * @author Luis Josafat Heredia Contreras
 */
class ModelsGenerate extends GeneratorCommand
{
    use LogicBusiness;
    
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;
    
    /**
     * The fields in process
     */
    protected $fields;
    
    /**
     * The table in process
     */
    protected $table;
    
    /**
     * The tables in database connection
     */
    protected $tables;
    
    /**
     * The database connection
     */
    protected $connection;
    
    /**
     * The connection name in process
     */
    protected $connectionName;
    
    protected $fieldsStamps = [
        'createdAt',
        'updatedAt',
    ];


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
        
        $structTables = $this->reverseStruct($connection, $this->getTablesGenerate());
        
        if( $structTables === false) {
            
            return FALSE;
            
        }
        
        if( empty($structTables)) {
            
            $this->info('empty struct tables');
            return true;
            
        }
        
        return $this->createFiles($structTables);
        
    }
    
    public function createFiles($structTables)
    {
        
        $flag = true;
        
        foreach($structTables as $table => $fields) {
            
            $flag = $this->createFileModel($table, $fields);
            
            if( !$flag) {

                $this->error('Imposible create file Class model {t}', [
                    't'=>$table
                ]);
                break;

            }
            
        }
        
        return $flag;
        
    }
    
    public function getConnection($group)
    {
        
        $this->connectionName = $group;
        
        return $this->connection = \DB::connection($group);;
        
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
    
    public function getTables()
    {
        
        $result = $this->connection->select('show tables');
        $database = $this->connection->getConfig('database');
        $tables = [];
        
        foreach($result as $i=>$table)
        {
            
            $tables []= $table->{'Tables_in_' . $database};
            
        }
        
        return $this->tables = $tables;
        
    }
    
    public function reverseStruct(&$connection, $listTables)
    {
        
        $struct = [];
        $flag = TRUE;
        
        foreach($listTables as $table) {
            
            $fields = $this->getFieldMetadata($connection, $table);
            
            if( empty($fields)) {
                
                continue;
                
            }
            
            $struct [$table]= $this->prepareConfig($fields);
            
        }
        
        return $struct;
        
    }
    
    public function createFileModel($table, array $fields)
    {
        
        $this->table = $table;
        $this->fields = $fields;
        $prefix = $this->connection->getConfig('prefix');
        
        if( !empty($prefix) && substr($table, 0, strlen($prefix)) == $prefix) {
            
            $table = substr($table, strlen($prefix));
            
        }
        
        return $this->create(ucfirst($table));
        
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
            
        }
        
        $stub = str_replace(
            'DummyTable', $this->table, $stub
        );
        $stub = str_replace(
            'DummyConnection', $this->connectionName, $stub
        );
        
        $stub = str_replace(
            'DummyFields', "'" . implode("', '", array_keys($this->fields)) . "'", $stub
        );
        
        $this->replaceTimestamps($stub);
        $this->replaceIncrementing($stub);
        
        return $this;
        
    }
    
    public function replaceIncrementing(&$stub)
    {
        
        if( !isset($this->fields['id']) ||
            !isset($this->fields['id']['autoIncrement']) || 
            !$this->fields['id']['autoIncrement']) {
            
            return $this;
            
        }
        
        $stub = str_replace(
            '/* incrementing */', 'public $incrementing = true;', $stub
        );
        
    }
    
    public function replaceTimestamps(&$stub)
    {
        
        $fieldsKeys = array_keys($this->fields);
        
        $findCount = 0;
        
        foreach($this->fieldsStamps as $field) {
            
            if( in_array($field, $fieldsKeys, true)) {
                
                ++$findCount;
                
            }
            
        }
        
        if( $findCount !== 2) {
            
            $stub = str_replace(
                '/* timestamps */', 'public $timestamps = false;', $stub
            );
            
        } else {
            
            $stub = str_replace(
                '/* timestamps */', 'public $timestamps = true;', $stub
            );
            
        }
        
    }
    
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models';
    }
    
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        
        $fields = $this->fields;
        
        if( !isset($fields['id'])) {
            
            return __DIR__.'/../stubs/models.stub';
            
        }
        
        if( isset($fields['id']['isPrimaryKey']) && 
            $fields['id']['isPrimaryKey'] && 
            isset($fields['id']['isUuid']) && 
            $fields['id']['isUuid']) {
            
            return __DIR__.'/../stubs/modelsUuid.stub';
            
        }
        
        return __DIR__.'/../stubs/models.stub';
        
    }
    
    public function getFieldMetadata(&$connection, $table)
    {
        
        $prefix = $connection->getConfig('prefix');
        
        if( empty($prefix)) {
            
            $table = lcfirst($table);
            
        }
        
        /* extract to http://lucidchart.com/ */
        $columns = $connection->select('SELECT c.COLUMN_NAME, c.ORDINAL_POSITION, c.DATA_TYPE, c.CHARACTER_MAXIMUM_LENGTH, c.COLUMN_DEFAULT, c.IS_NULLABLE, c.NUMERIC_PRECISION, c.NUMERIC_SCALE, n.CONSTRAINT_TYPE, k.REFERENCED_TABLE_SCHEMA, k.REFERENCED_TABLE_NAME, k.REFERENCED_COLUMN_NAME, t.AUTO_INCREMENT         FROM INFORMATION_SCHEMA.TABLES t         LEFT JOIN INFORMATION_SCHEMA.COLUMNS c ON t.TABLE_SCHEMA=c.TABLE_SCHEMA AND t.TABLE_NAME=c.TABLE_NAME         LEFT JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE k ON c.TABLE_SCHEMA=k.TABLE_SCHEMA AND c.TABLE_NAME=k.TABLE_NAME AND c.COLUMN_NAME=k.COLUMN_NAME         LEFT JOIN INFORMATION_SCHEMA.TABLE_CONSTRAINTS n ON k.CONSTRAINT_SCHEMA=n.CONSTRAINT_SCHEMA AND k.CONSTRAINT_NAME=n.CONSTRAINT_NAME AND k.TABLE_SCHEMA=n.TABLE_SCHEMA AND k.TABLE_NAME=n.TABLE_NAME         WHERE t.TABLE_TYPE=\'BASE TABLE\' AND t.TABLE_NAME = "' . $table . '"');
        
        $fieldColumn = [];
        
        foreach ($columns as $i => $column) {
            
            $fieldColumn[$i] = new \stdClass();
            $fieldColumn[$i]->name = $column->COLUMN_NAME;
            $fieldColumn[$i]->type = $column->DATA_TYPE;
            $fieldColumn[$i]->max_length = ($column->CHARACTER_MAXIMUM_LENGTH > 0) ? 
                    (int)$column->CHARACTER_MAXIMUM_LENGTH : 
                    (int)$column->NUMERIC_PRECISION;

            if( !is_null($column->COLUMN_DEFAULT)) {
                
                if( in_array($fieldColumn[$i]->type, [
                    'int',
                    'smallint'
                ])) {
                    
                    $fieldColumn[$i]->default = (int)$column->COLUMN_DEFAULT;
                    
                } else if( in_array($fieldColumn[$i]->type, [
                    'datetime',
                ])) {
                    
                    $fieldColumn[$i]->default = $column->COLUMN_DEFAULT;
                    
                } else if( in_array($fieldColumn[$i]->type, [
                    'tinyint'
                ])) {
                    
                    $fieldColumn[$i]->default = (bool)$column->COLUMN_DEFAULT;
                    
                } else {
                    
                    $fieldColumn[$i]->default = $column->COLUMN_DEFAULT;
                    
                }
                
            } else {
                
                $fieldColumn[$i]->default = NULL;
                
            }
            
            if( $fieldColumn[$i]->type == 'decimal') {
                
                $fieldColumn[$i]->scale = (int)$column->NUMERIC_SCALE;
                
            }
            
            $fieldColumn[$i]->primary_key =  $column->CONSTRAINT_TYPE === 'PRIMARY KEY' ? TRUE : FALSE;
            
            $fieldColumn[$i]->null = $column->IS_NULLABLE === 'NO' ? FALSE : TRUE;
            
            if( $fieldColumn[$i]->primary_key) {
                
                $fieldColumn[$i]->auto_increment = is_null($column->AUTO_INCREMENT) ? FALSE : TRUE;
                        
            }
            
            if($column->CONSTRAINT_TYPE === 'FOREIGN KEY') {
                
                $fieldColumn[$i]->isForeignKey = TRUE;
                $fieldColumn[$i]->related = [
                    'database'=>$column->REFERENCED_TABLE_SCHEMA,
                    'table'=>$column->REFERENCED_TABLE_NAME,
                    'column'=>$column->REFERENCED_COLUMN_NAME
                ];
                
            } else {
                
                $fieldColumn[$i]->isForeignKey = FALSE;
                
            }
            
        }
        
        return $fieldColumn;
        
    }
    
    public function prepareConfig(&$fields)
    {
        
        $fieldsConfig = array();
        
        foreach($fields as $field) {
            
            $fieldConfig = array();
            
            if( $field->primary_key) {
                
                $fieldConfig['json_input'] = TRUE;
                $fieldConfig['isPrimaryKey'] = TRUE;
                $fieldConfig['autoIncrement'] = isset($field->auto_increment) ? 
                    $field->auto_increment : false;
                
            }
            
            if( $field->isForeignKey) {
                
                $fieldConfig['isForeignKey']= TRUE;
                $fieldConfig['related']= [
                    'tabla'=>$field->related['table'],
                    'columna'=>$field->related['column'],
                ];
                
            }
            
            if( in_array($field->type, [
                'varchar',
                'char',
                'nvarchar',
                'text'
            ])) {
                
                $fieldConfig['tipo'] = 'cadena';
                $fieldConfig['validador'] = 'texto';
                $fieldConfig['size'] = $field->max_length;
                
            } else if( in_array($field->type, [
                'datetime',
                'datetime2',
            ])){
                
                $fieldConfig['tipo'] = 'fecha_tiempo';
                
            } else if( in_array($field->type, [
                'tinyint',
                'boolean'
            ])) {
                
                $fieldConfig['tipo'] = 'booleano';
                
            } else if( in_array($field->type, [
                'decimal'
            ])) {
                
                $fieldConfig['tipo'] = 'decimal';
                $fieldConfig['size'] = $field->max_length;
                $fieldConfig['scale'] = $field->scale;
                
                
            } else {
                
                $fieldConfig['size'] = $field->max_length;
                
            }
            
            if( $field->null) {
                
                $fieldConfig['requerido'] = FALSE;
                
            }
            
            if( !is_null($field->default)) {
                
                $fieldConfig['default'] = $field->default;
                
            }
            
            if($field->primary_key && $field->max_length == 36) {
                
                $fieldConfig['validador'] = 'uuid';
                $fieldConfig['isUuid'] = TRUE;
                
            }
            
            $fieldsConfig[$field->name] = $fieldConfig;
            
        }
        
        return $fieldsConfig;
        
    }

}
