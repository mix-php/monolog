<?php

namespace Mix\Log;

use Mix\Core\Component\AbstractComponent;

/**
 * Class MultiHandler
 * @package Mix\Log
 * @author LIUJIAN <coder.keda@gmail.com>
 */
class MultiHandler extends AbstractComponent implements HandlerInterface
{

    /**
     * 标准输出处理器
     * @var \Mix\Log\StdoutHandler
     */
    public $stdoutHandler;

    /**
     * 文件处理器
     * @var \Mix\Log\FileHandler
     */
    public $fileHandler;

    /**
     * 写入日志
     * @param $level
     * @param $message
     * @return bool
     */
    public function write($level, $message)
    {
        // TODO: Implement write() method.
        if (isset($this->stdoutHandler)) {
            $this->stdoutHandler->write($level, $message);
        }
        if (isset($this->fileHandler)) {
            $this->fileHandler->write($level, $message);
        }
    }

}
