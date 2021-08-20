<?php
namespace Lingxiao\Swoft\MemoryTable;

use Lingxiao\Swoft\MemoryTable\Exception\MemoryTableException;
use Swoft\Bean\Annotation\Mapping\Bean;
use \Swoole\Table as SwooleTable;

/**
 * Class MemoryTable
 * @package Lingxiao\Swoft\MemoryTable
 * @Bean()
 */
class MemoryTable
{
    protected $tableConf;

    protected $tablePoll;

    public function init(){
        if (empty($this->tableConf)){
            throw new MemoryTableException('tableConf Not Set');
        }
        foreach ($this->tableConf as $conf){
            if (!isset($this->tablePoll[$conf['name']])){
                if (!isset($conf['name'])){
                    throw new MemoryTableException('tableName Not Set');
                }
                $table = new SwooleTable($conf['tableSize']);
                foreach ($conf['column'] as $column){
                    $table->column($column['name'], $column['type'], $column['size']);
                }
                $table->create();
                $tableObject  = new $conf['class'];
                $tableObject->setTable($table);
                $this->tablePoll[$conf['name']] = $tableObject;
            }
        }
    }

    /**
     * @param $tableName
     * @return mixed
     */
    public function table($tableName){
        if (isset($this->tablePoll[$tableName])){
            return $this->tablePoll[$tableName];
        } else {
            throw new MemoryTableException('MemoryTable Does Not Exist');
        }
    }

}