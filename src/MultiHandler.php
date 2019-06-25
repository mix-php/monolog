<?php

namespace Mix\Log;

use Mix\Bean\BeanInjector;

/**
 * Class MultiHandler
 * @package Mix\Log
 * @author liu,jian <coder.keda@gmail.com>
 */
class MultiHandler implements LoggerHandlerInterface
{

    /**
     * 日志处理器集合
     * @var LoggerHandlerInterface[]
     */
    public $handlers = [];

    /**
     * Authorization constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        BeanInjector::inject($this, $config);
    }

    /**
     * 写入日志
     * @param $level
     * @param $message
     * @return bool
     */
    public function write($level, $message)
    {
        // TODO: Implement write() method.
        foreach ($this->handlers as $handler) {
            /** @var LoggerHandlerInterface $handler */
            $handler->write($level, $message);
        }
        return true;
    }

}
