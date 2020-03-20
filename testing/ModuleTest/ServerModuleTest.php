<?php
/**
 * Created by PhpStorm.
 * User: Zhangrui
 * Date: 2019/12/25
 * Time: 14:09
 */

namespace SwozrTest\Taskr\Server\ModuleTest;


use Swozr\Taskr\Server\Base\BaseTask;
use Swozr\Taskr\Server\Event\ServerEvent;
use Swozr\Taskr\Server\Event\SwooleEvent;
use Swozr\Taskr\Server\Server;
use Swozr\Taskr\Server\Swozr;
use Swozr\Taskr\Server\TaskrEngine;
use SwozrTest\Taskr\Server\Listener\TestHandleListener;
use SwozrTest\Taskr\Server\Tasks\TaskHandleTest;

require __DIR__ . '/../../vendor/autoload.php';

class ServerModuleTest
{

}

(new TaskrEngine([
    'debug' => true,
//    'crontabs' => [TaskHandleTest::class],
    'listener' => [
        ServerEvent::BEFORE_START => TestHandleListener::class,
        ServerEvent::WORK_PROCESS_START => TestHandleListener::class
    ],
    'rabbmitMqs' => [
        'class' => TaskHandleTest::class,
        'host'  => '192.168.99.100',
        'exchange_name' => 'a',
        'queue_name' => 'a',
        'routing_key' => 'c',
    ],
]))->start();
