<?php

namespace Mix\Log;

use Mix\Core\Component\AbstractComponent;
use Mix\Core\Component\ComponentInterface;
use Mix\Helper\ProcessHelper;
use Psr\Log\LoggerInterface;

/**
 * Class Logger
 * @package Mix\Log
 * @author liu,jian <coder.keda@gmail.com>
 */
class Logger extends AbstractComponent implements LoggerInterface
{

    /**
     * 协程模式
     * @var int
     */
    const COROUTINE_MODE = ComponentInterface::COROUTINE_MODE_REFERENCE;

    /**
     * 日志记录级别
     * @var array
     */
    public $levels = ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'];

    /**
     * 处理者
     * @var \Mix\Log\LoggerHandlerInterface
     */
    public $handler;

    /**
     * emergency日志
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function emergency($message, array $context = [])
    {
        return $this->log(__FUNCTION__, $message, $context);
    }

    /**
     * alert日志
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function alert($message, array $context = [])
    {
        return $this->log(__FUNCTION__, $message, $context);
    }

    /**
     * critical日志
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function critical($message, array $context = [])
    {
        return $this->log(__FUNCTION__, $message, $context);
    }

    /**
     * error日志
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function error($message, array $context = [])
    {
        return $this->log(__FUNCTION__, $message, $context);
    }

    /**
     * warning日志
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function warning($message, array $context = [])
    {
        return $this->log(__FUNCTION__, $message, $context);
    }

    /**
     * notice日志
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function notice($message, array $context = [])
    {
        return $this->log(__FUNCTION__, $message, $context);
    }

    /**
     * info日志
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function info($message, array $context = [])
    {
        return $this->log(__FUNCTION__, $message, $context);
    }

    /**
     * debug日志
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function debug($message, array $context = [])
    {
        return $this->log(__FUNCTION__, $message, $context);
    }

    /**
     * 记录日志
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function log($level, $message, array $context = [])
    {
        $levels = ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'];
        if (!in_array($level, $levels) || in_array($level, $this->levels)) {
            $message = static::interpolate($message, $context);
            $time    = date('Y-m-d H:i:s');
            $pid     = ProcessHelper::getPid();
            $message = "[{$level}] {$time} <{$pid}> [message] {$message}" . PHP_EOL;
            return $this->handler->write($level, $message);
        }
        return false;
    }

    /**
     * @param $message
     * @param array $context
     * @return string
     */
    protected static function interpolate($message, array $context = [])
    {
        // build a replacement array with braces around the context keys
        $replace = [];
        foreach ($context as $key => $val) {
            // check that the value can be casted to string
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }
        // interpolate replacement values into the message and return
        return strtr($message, $replace);
    }

}
