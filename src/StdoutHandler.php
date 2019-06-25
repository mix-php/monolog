<?php

namespace Mix\Log;

use Mix\Console\CommandLine\Color;

/**
 * Class StdoutHandler
 * @package Mix\Log
 * @author liu,jian <coder.keda@gmail.com>
 */
class StdoutHandler implements LoggerHandlerInterface
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
        // FastCGI 模式下不打印
        if (!(PHP_SAPI === 'cli')) {
            return;
        }
        // win 系统普通打印
        if (stripos(PHP_OS, 'WIN') !== false) {
            echo $message;
            return true;
        }
        // 带颜色打印
        switch ($level) {
            case 'error':
                Color::new(Color::FG_RED)->print($message);
                break;
            case 'warning':
                Color::new(Color::FG_YELLOW)->print($message);
                break;
            case 'notice':
                Color::new(Color::FG_GREEN)->print($message);
                break;
            case 'info':
                Color::new(Color::FG_BLUE)->print($message);
                break;
            default:
                echo $message;
        }
        return true;
    }

}
