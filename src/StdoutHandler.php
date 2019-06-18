<?php

namespace Mix\Log;

use Mix\Console\CommandLine\Color;
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
        // FastCGI 模式下不打印
        if (!PhpHelper::isCli()) {
            return;
        }
        // win 系统普通打印
        if (PhpHelper::isWin()) {
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
