<?php

namespace Mix\Log;

/**
 * Interface HandlerInterface
 * @package Mix\Log
 * @author LIUJIAN <coder.keda@gmail.com>
 */
interface HandlerInterface
{

    /**
     * 写入日志
     * @param $level
     * @param $message
     * @return bool
     */
    public function write($level, $message);

}
