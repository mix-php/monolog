<?php

namespace Mix\Log;

/**
 * Interface LoggerHandlerInterface
 * @package Mix\Log
 * @author liu,jian <coder.keda@gmail.com>
 */
interface LoggerHandlerInterface
{

    /**
     * 写入日志
     * @param $level
     * @param $message
     * @return bool
     */
    public function write($level, $message);

}
