<?php

/**
 * Log class
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

class Log {
    private $data;

    private $type = 1;



    public function __construct($data, int $type = 1){
        $this->setData($data)
            ->setType($type);
    }



    /**
     * Set data
     *
     * @param $data mixed
     *
     * @return self
    */
    public function setData($data) : self {
        $this->data = $data;

        return $this;
    }

    /**
     * Return data
     *
     * @return mixed
    */
    public function getData() {
        return $this->data;
    }



    /**
     * Set log type ( @see Logger::LOG_LEVEL_WARN, Logger::LOG_LEVEL_NOTICE, Logger::LOG_LEVEL_FATAL, Logger::LOG_LEVEL_PARSE )
     *
     * @param int $type
     *
     * @return self
     */
    public function setType(int $type) : self {
        $this->type = $type;

        return $this;
    }

    /**
     * Return log type ( @see Logger::LOG_LEVEL_WARN, Logger::LOG_LEVEL_NOTICE, Logger::LOG_LEVEL_FATAL, Logger::LOG_LEVEL_PARSE )
     *
     * @return int
    */
    public function getType() : int {
        return $this->type;
    }


    /**
     * Save data to file
     *
     * @return bool
    */
    public function save() : bool {
        $path = Logger::getPath();

        if(!is_dir($path)){
            if(!@mkdir($path, 0777, true)){
                return false;
            }
        }

        $filename = 'undefined.log';

        switch($this->getType()){
            case Logger::LOG_LEVEL_WARN: $filename = 'warning.php'; break;
            case Logger::LOG_LEVEL_NOTICE: $filename = 'notice.php'; break;
            case Logger::LOG_LEVEL_FATAL: $filename = 'fatal.php'; break;
            case Logger::LOG_LEVEL_PARSE: $filename = 'parse.php'; break;
        }

        $filename = "{$path}/{$filename}";

        if(!is_file($filename)){
            $file = [];
        }else{
            if(!is_readable($filename) || !is_writable($filename)){
                return false;
            }

            $file = (include($filename));
        }

        $size = count($file);

        if($size >= Logger::getMaxLines()){
            $file = array_slice($file, 0, Logger::getMaxLines() - 1);
        }

        $data = date('Y-m-d H:i:s').' | '.var_export($this->getData(), true);

        array_unshift($file, $data);

        $tosave = "<?php".PHP_EOL.PHP_EOL;

        $tosave .= "return ".var_export($file, true).";".PHP_EOL.PHP_EOL;

        $tosave .= "?>";

        $put = @file_put_contents($filename, $tosave, LOCK_EX);

        return $put !== false;
    }
}

?>