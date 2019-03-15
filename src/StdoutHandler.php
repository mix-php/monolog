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
        echo $message . PHP_EOL;
    }

}
