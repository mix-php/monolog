<?php

namespace Mix\Log;

use Mix\Core\Component\AbstractComponent;
use Mix\Helper\PhpHelper;

/**
 * Class StdoutHandler
 * @package Mix\Log
 * @author liu,jian <coder.keda@gmail.com>
 */
class StdoutHandler extends AbstractComponent implements LoggerHandlerInterface
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
        // 兼容 FastCGI 模式
        if (!PhpHelper::isCli()) {
            return;
        }
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
        $time    = date('Y-m-d H:i:s');
        $message = "[time] {$time} [message] {$message}";
        $message = "[{$level}] {$message}";
        return $message;
    }

}
