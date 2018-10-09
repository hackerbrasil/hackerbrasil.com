<?php
namespace Basic;

use Medoo\Medoo;

class Migration
{
    public $db;
    public function __construct($db = null)
    {
        if (is_null($db)) {
            die('medoo instance injection fail');
        } else {
            $this->db = $db;
        }
    }
    public function dropAll()
    {
        $tables=$this->tables();
        if ($tables) {
            foreach ($tables as $table) {
                $sql="DROP TABLE $table;";
                $this->query($sql);
            }
            return true;
        } else {
            return false;
        }
    }
    public function migrateAll($filename=false)
    {
        if(!$filename){
            $filename=ROOT.'app/model/';
        }
        //verifica se a pasta das tabelas existe
        if (file_exists($filename)) {
            $dir=$filename;
        } else {
            $dir=ROOT.'table/';
        }
        $tablesRAW=$this->myScanDir($dir);
        $tables=null;
        //processa as tabelas
        foreach ($tablesRAW as $key => $value) {
            if ($this->validColumn($value)) {
                $content=file_get_contents($dir.$value);
                $content=explode(PHP_EOL, $content);
                foreach ($content as $contentKey => $contentValue) {
                    if (!$this->validColumn($contentValue)) {
                        unset($content[$contentKey]);
                    }
                }
                $content=array_filter($content);
                $content=array_values($content);
                $tables[$value]=$content;
            }
        }
        $tabelasNoBanco=$this->tables();
        if ($tabelasNoBanco) {
            //exclusão de tabelas
            foreach ($tabelasNoBanco as $key => $tableName) {
                //apaga as tabelas órfãs
                if (!isset($tables[$tableName])) {
                    $this->deleteTable($tableName);
                }
                unset($tabelasNoBanco[$key]);
            }
        }
        if(count($tabelasNoBanco)>0){
            //exclusão de colunas
            foreach ($tabelasNoBanco as $keyTableInDB => $tableName) {
                //le as colunas que já existe na tabelas
                $columnsInDB=$this->columns($tableName);
                //apaga as colunas que estão sobrando
                foreach ($columnsInDB as $keyColumnsInDB => $valueColumnInDB) {
                    if (!in_array($valueColumnInDB, $tables[$tableName])) {
                        $this->deleteColumn($tableName, $valueColumnInDB);
                    }
                }
            }
        }
        //criação de colunas
        foreach ($tables as $tableKey => $tableValues) {
            $tableName=$tableKey;
            if (!$this->tableExists($tableName)) {
                $this->createTable($tableName);
            }
            $this->createColumn($tableName, 'id');
            foreach ($tableValues as $columnName) {
                $this->createColumn($tableName, $columnName);
            }
        }
        return true;
    }
    public function truncateAll()
    {
        $tables=$this->tables();
        foreach ($tables as $table) {
            $sql="TRUNCATE $table;";
            $this->query($sql);
        }
        return true;
    }
    public function columnExists(string $tableName, string $columnName)
    {
        $tableName=trim($tableName);
        $columnName=trim($columnName);
        $columns=$this->columns($tableName);
        if (@in_array($columnName, $columns)) {
            return true;
        } else {
            return false;
        }
    }
    public function columns(string $tableName)
    {
        $tableName=trim($tableName);
        if (!$this->tableExists($tableName)) {
            return false;
        }
        $sql='SHOW COLUMNS FROM '.$tableName;
        $result=$this->query($sql);
        if (is_array($result)) {
            $array=null;
            foreach ($result as $key => $value) {
                $array[]=$value['Field'];
            }
            return $array;
        } else {
            return false;
        }
    }
    public function createColumn(string $tableName, string $columnName)
    {
        $tableName=trim($tableName);
        $columnName=trim($columnName);
        if (!$this->columnExists($tableName, $columnName)) {
            $sql='ALTER TABLE `'.$tableName.'` ADD ';
            if ($columnName=='id') {
                $sql=$sql.'`'.$columnName.'` serial;';
            } else {
                // ALTER TABLE `user` ADD `email` LONGTEXT NOT NULL ;
                $sql=$sql.'`'.$columnName.'` LONGTEXT;';
            }
            if (!$this->columnExists($tableName, $columnName)) {
                return $this->query($sql);
            }
        }
    }
    public function createTable(string $tableName)
    {
        $tableName=trim($tableName);
        $sql='CREATE TABLE IF NOT EXISTS `'.$tableName.'`(id serial) ENGINE=INNODB;';
        $return=$this->query($sql);
        return $return;
    }
    public function deleteColumn(string $tableName, string $columnName)
    {
        if ($columnName!='id') {
            $tableName=trim($tableName);
            $columnName=trim($columnName);
            $sql='ALTER TABLE '.$tableName.' DROP COLUMN '.$columnName;
            return $this->query($sql);
        }
    }
    public function deleteTable(string $tableName)
    {
        $tableName=trim($tableName);
        $sql='DROP TABLE IF EXISTS '.$tableName;
        return $this->query($sql);
    }
    public function myScanDir(string $dir)
    {
        $ignored = array('.', '..', '.svn', '.htaccess');
        $files = array();
        foreach (scandir($dir) as $file) {
            if (in_array($file, $ignored)) {
                continue;
            }
            $files[$file] = filemtime($dir.$file);
        }
        arsort($files);
        $files = array_keys($files);
        return ($files) ? $files : false;
    }
    public function query(string $sql)
    {
        return $this->db->query($sql)->fetchAll();
    }
    public function renameColumn(string $tableName, string $oldColumnName, string $create_columnName)
    {
        $tableName=trim($tableName);
        $oldColumnName=trim($oldColumnName);
        $create_columnName=trim($create_columnName);
        if (!$this->tableExists($tableName)) {
            return false;
        }
        if ($this->columnExists($tableName, $oldColumnName)) {
            $sql='ALTER TABLE `'.$tableName.'` CHANGE ';
            $sql=$sql.'`'.$oldColumnName.'` `'.$create_columnName.'` longtext';
            return $this->query($sql);
        } else {
            return false;
        }
    }
    public function tables()
    {
        $sql='SHOW TABLES';
        $result=$this->query($sql);
        if (is_array($result)) {
            $array=null;
            foreach ($result as $key => $value) {
                $array[]=array_values($value)[0];
            }
            return $array;
        } else {
            return false;
        }
    }
    public function tableExists(string $tableName)
    {
        $tableName=trim($tableName);
        $tables=$this->tables();
        if (@in_array($tableName, $tables)) {
            return true;
        } else {
            return false;
        }
    }
    public function validColumn(string $columnName)
    {
        $columnName=trim($columnName);
        $allowed = array("_");
        if (ctype_alpha(str_replace($allowed, '', $columnName))) {
            return $columnName;
        } else {
            return false;
        }
    }
}
