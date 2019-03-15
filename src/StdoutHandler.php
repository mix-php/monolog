<?php

namespace Mix\Log;

use Mix\Core\Component\AbstractComponent;

/**
 * Class StdoutHandler
 * @package Mix\Log
 * @author LIUJIAN <coder.keda@gmail.com>
 */
class StdoutHandler extends AbstractComponent implements HandlerInterface
{

    /**
     * 写入日志
     * @param $level
     * @param $message
     * @return bool
     */
    public function write($level, $message)
    {
        // TODO: Implement write() method.
        echo $this->getMessage($level, $message) . PHP_EOL;
    }

    /**
     * 获取消息
     * @param $level
     * @param $message
     * @return string
     */
    protected function getMessage($level, $message)
    {
        $time = date('Y-m-d H:i:s');
        $message = "[time] {$time} [message] {$message}";
        $message = "[{$level}] {$message}";
        return $message;
    }

}
