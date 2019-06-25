<?php

namespace Mix\Log;

use Mix\Bean\BeanInjector;
use Mix\Helper\FileSystemHelper;

/**
 * Class FileHandler
 * @package Mix\Log
 * @author liu,jian <coder.keda@gmail.com>
 */
class FileHandler implements LoggerHandlerInterface
{

    /**
     * 轮转规则
     */
    const ROTATE_HOUR = 1;
    const ROTATE_DAY = 2;
    const ROTATE_WEEKLY = 3;

    /**
     * 单文件
     * @var string
     */
    public $single = '';

    /**
     * 日志目录
     * @var string
     */
    public $dir = '';

    /**
     * 日志轮转类型
     * @var int
     */
    public $rotate = self::ROTATE_DAY;

    /**
     * 最大文件尺寸
     * @var int
     */
    public $maxFileSize = 0;

    /**
     * Authorization constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        BeanInjector::inject($this, $config);
    }

    /**
     * 写入日志
     * @param $level
     * @param $message
     * @return bool
     */
    public function write($level, $message)
    {
        $file = $this->getLogFile($level);
        if (!$file) {
            return false;
        }
        return error_log($message, 3, $file);
    }

    /**
     * 获取日志文件
     * @param $level
     * @return bool|string
     */
    protected function getLogFile($level)
    {
        // 没有文件信息
        if (!$this->single && !$this->dir) {
            return false;
        }
        // 单文件
        if ($this->single) {
            return $this->single;
        }
        // 生成文件名
        $logDir = $this->getLogDir();
        switch ($this->rotate) {
            case self::ROTATE_HOUR:
                $subDir     = date('Ymd');
                $timeFormat = date('YmdH');
                break;
            case self::ROTATE_DAY:
                $subDir     = date('Ym');
                $timeFormat = date('Ymd');
                break;
            case self::ROTATE_WEEKLY:
                $subDir     = date('Y');
                $timeFormat = date('YW');
                break;
            default:
                $subDir     = '';
                $timeFormat = '';
        }
        $filename = $logDir . ($subDir ? DIRECTORY_SEPARATOR . $subDir : '') . DIRECTORY_SEPARATOR . $level . ($timeFormat ? '_' . $timeFormat : '');
        $file     = "{$filename}.log";
        // 创建目录
        $dir = dirname($file);
        is_dir($dir) or mkdir($dir, 0777, true);
        // 尺寸轮转
        $number = 0;
        while (file_exists($file) && $this->maxFileSize > 0 && filesize($file) >= $this->maxFileSize) {
            $file = "{$filename}_" . ++$number . '.log';
        }
        // 返回
        return $file;
    }

    /**
     * 获取日志目录
     * @return string
     */
    protected function getLogDir()
    {
        $cacheDir = $this->dir;
        $isMix    = class_exists(\Mix::class);
        if ($isMix && !static::isAbsolute($cacheDir)) {
            $cacheDir = \Mix::$app->getRuntimePath() . DIRECTORY_SEPARATOR . $this->dir;
        }
        return $cacheDir;
    }

    /**
     * 判断是否为绝对路径
     * @param $path
     * @return bool
     */
    protected static function isAbsolute($path)
    {
        if (($position = strpos($path, './')) !== false && $position <= 2) {
            return false;
        }
        if (strpos($path, ':') !== false) {
            return true;
        }
        if (substr($path, 0, 1) === '/') {
            return true;
        }
        return false;
    }

}
