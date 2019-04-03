<?php

namespace Mix\Log;

use Mix\Core\Component\AbstractComponent;

/**
 * Class MultiHandler
 * @package Mix\Log
 * @author liu,jian <coder.keda@gmail.com>
 */
class MultiHandler extends AbstractComponent implements LoggerHandlerInterface
{

    /**
     * 日志处理器集合
     * @var \Mix\Log\LoggerHandlerInterface[]
     */
    public $handlers = [];

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
