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
        $tables=$this->tabelasNoBanco();
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
    public function migrateAll($dir=false)
    {
        $defaultDir=ROOT.'table/';
        if(!$dir){
            $dir=$defadefaultDir;
        }
        if (file_exists($dir)) {
            $dir=$dir;
        } else {
            $dir=$defadefaultDir;
        }
        //le os nomes das tabelas
        $listaDeTabelas=$this->myScanDir($dir);
        $tables=null;
        //processa as tabelas
        foreach ($listaDeTabelas as $key => $nomeDaTabela) {
            //verifica se o nome da tabela é valido
            if ($this->validColumn($nomeDaTabela)) {
                $content=file_get_contents($dir.$nomeDaTabela);
                $content=explode(PHP_EOL, $content);
                $content=array_filter($content);
                $content=array_values($content);
                foreach ($content as $contentKey => $nomeDaColuna) {
                    if (!$this->validColumn($nomeDaColuna)) {
                        unset($content[$contentKey]);
                    }
                }
                $tables[$nomeDaTabela]=$content;
            }
        }
        $tabelasNoBanco=$this->tabelasNoBanco();
        if ($tabelasNoBanco) {
            //exclusão de tabelas
            foreach ($tabelasNoBanco as $key => $tableName) {
                //apaga as tabelas órfãs
                if (!isset($tables[$tableName])) {
                    $this->deleteTable($tableName);
                    unset($tabelasNoBanco[$key]);
                }
            }
        }
        if(count($tabelasNoBanco)>0){
            //exclusão de colunas
            foreach ($tabelasNoBanco as $tableName) {
                //le as colunas que já existe na tabela
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
        $tables=$this->tabelasNoBanco();
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
                // ALTER TABLE `user` ADD `email` TEXT NOT NULL ;
                $sql=$sql.'`'.$columnName.'` TEXT;';
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
        if($files){
            return $files;
        }else{
            return false;
        }
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
            $sql=$sql.'`'.$oldColumnName.'` `'.$create_columnName.'` TEXT';
            return $this->query($sql);
        } else {
            return false;
        }
    }
    public function tabelasNoBanco()
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
        $tables=$this->tabelasNoBanco();
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
