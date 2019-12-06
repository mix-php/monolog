<?php

namespace Mix\Log;

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
     * MultiHandler constructor.
     * @param LoggerHandlerInterface ...$handlers
     */
    public function __construct(LoggerHandlerInterface ...$handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * 处理日志
     * @param $level
     * @param $message
     */
    public function handle($level, $message)
    {
        foreach ($this->handlers as $handler) {
            /** @var LoggerHandlerInterface $handler */
            $handler->handle($level, $message);
        }
    }

}
