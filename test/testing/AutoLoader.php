<?php declare(strict_types=1);

namespace Lingxiao\Swoft\MemoryTable\test\testing;

use Swoft\SwoftComponent;

/**
 * Class AutoLoader
 */
class AutoLoader extends SwoftComponent
{
    /**
     * Get namespace and dir
     *
     * @return array
     * [
     *     namespace => dir path
     * ]
     */
    public function getPrefixDirs(): array
    {
        return [
            __NAMESPACE__ => __DIR__,
        ];
    }

    /**
     * Metadata information for the component.
     *
     * @return array
     * @see ComponentInterface::getMetadata()
     */
    public function metadata(): array
    {
        return [];
    }

    /**
     * @return string[][]
     */
    public function beans(): array
    {
        return [
            'MemoryTable' =>
                [
                    'class'         => \Lingxiao\Swoft\MemoryTable\MemoryTable::class,
                    'tableConf' => [
                        [
                            'name' => 'test',
                            'class' => \Lingxiao\Swoft\MemoryTable\Table::class,
                            'tableSize' => 1024,
                            'column' => [
                                ['name' => 'id', 'type'=> \Swoole\Table::TYPE_STRING,'size' =>8],
                                ['name' => 'value', 'type'=> \Swoole\Table::TYPE_STRING,'size' =>20],
                            ]
                        ],
                    ]
                ]
        ];
    }
}
