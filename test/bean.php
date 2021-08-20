<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace Lingxiao\Swoft\MemoryTable\test;

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
