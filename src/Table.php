<?php
namespace Lingxiao\Swoft\MemoryTable;

use Closure;
use \Swoole\Table as SwooleTable;
use Lingxiao\Swoft\MemoryTable\Exception\MemoryTableException;

class Table
{
    /**
     * @var SwooleTable
     */
    private $table;

    /**
     * 初始化
     * SwooleTable constructor.
     */
    private function init(array $columns,int $tableSize = 2048) :void
    {
        $table = new SwooleTable($tableSize);
        foreach ($columns as $column){
            $table->column($column['name'], $column['type'], $column['size']);
        }
        $table->create();
        $this->table = $table;
    }


    public function __call(string $method, array $parameters)
    {
        try {
            if (false === method_exists($this->table, $method)) {
                throw new MemoryTableException(sprintf('SwooleTable method(%s) is not supported!', $method));
            }
            return $this->table->{$method}(...$parameters);
        }catch (\Throwable $e){
            throw new MemoryTableException('SwooleTable Action error ='.$e->getMessage(),$e->getCode(),$e);
        }
    }

    /**
     * 获取并写入内存表
     * @param $key
     * @param Closure $data
     * @return mixed
     */
    public function remember($key,Closure $callback){

        $value = $this->table->key($key);
        if ($value){
            return $value;
        }
        $this->table->set($key, $value = $callback());
        return $value;
    }

    /**
     * @return SwooleTable
     */
    public function getTable(): SwooleTable
    {
        return $this->table;
    }

    /**
     * @param SwooleTable $table
     */
    public function setTable(SwooleTable $table): void
    {
        $this->table = $table;
    }
}