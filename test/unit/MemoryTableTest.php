<?php
/**
 * Class KafkaTopicTest
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Lingxiao\Swoft\MemoryTable\Test\unit;

use Exception;
use Lingxiao\Swoft\MemoryTable\MemoryTable;
use PHPUnit\Framework\TestCase;
use Swoft\Bean\BeanFactory;

class MemoryTableTest extends TestCase
{

    /**
     * @throws Exception
     */
    public function testMemoryTable()
    {
        /** @var MemoryTable $MemoryTable */
        $MemoryTable = BeanFactory::getBean(MemoryTable::class);
        sgo(function () use($MemoryTable){
            $MemoryTable->table('test')->set('testkey',['id'=>'1','value'=>2]);
            $res = $MemoryTable->table('test')->get('testkey');
            echo "Coroutine:";
            var_dump($res);
        });
        $MemoryTable->table('test')->set('testkey2',['id'=>'2','value'=>3]);
        $res = $MemoryTable->table('test')->get('testkey');
        var_dump($res);
    }

}
