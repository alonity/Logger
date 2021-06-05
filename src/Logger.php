<?php

/**
 * Logger class
 *
 *
 * @author Qexy admin@qexy.org
 *
 * @copyright © 2021 Alonity
 *
 * @package alonity\logger
 *
 * @license MIT
 *
 * @version 1.0.0
 *
 */

namespace alonity\logger;

class Logger {
    const VERSION = '1.0.0';

    const LOG_LEVEL_WARN = 0;

    const LOG_LEVEL_NOTICE = 1;

    const LOG_LEVEL_FATAL = 2;

    const LOG_LEVEL_PARSE = 3;

    private static $path = '';

    private static $maxLines = 10000;


    private static function searchRoot() : string {
        $pos = strpos(__FILE__, DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR);

        return substr(__FILE__, 0, $pos);
    }



    public static function setMaxLines(int $num){
        self::$maxLines = $num;
    }

    public static function getMaxLines() : int {
        return self::$maxLines;
    }



    /**
     * Set path to save logs
    */
    public static function setPath(string $path){
        self::$path = $path;
    }


    /**
     * Return path to save logs
     *
     * Default returned .../vendor/../tmp/logs
     *
     * @return string
    */
    public static function getPath() : string {
        if(empty(self::$path)){
            self::$path = self::searchRoot().'/tmp/logs';
        }

        return self::$path;
    }


    /**
     * Return log instance
     *
     * @param mixed $data
     *
     * @param int $type
     *
     * @return Log
    */
    public static function log($data, int $type = 1) : Log {
        return new Log($data, $type);
    }
}

?>