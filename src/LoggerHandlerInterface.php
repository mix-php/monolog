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
     * 处理日志
     * @param $level
     * @param $message
     * @return bool
     */
    public function handle($level, $message);

}
