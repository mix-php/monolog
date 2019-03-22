<?php

namespace Mix\Log;

/**
 * Interface LoggerHandlerInterface
 * @package Mix\Log
 * @author LIUJIAN <coder.keda@gmail.com>
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
