<?php

use alonity\logger\Logger;

ini_set('display_errors', true);
error_reporting(E_ALL);

require_once('../vendor/autoload.php');

// Set logs directory
Logger::setPath(dirname(__DIR__).'/tmp/mylogs');

// Set max log lines
Logger::setMaxLines(10); // Default is 10000

// Save default log (Logger::LOG_LEVEL_NOTICE = 1)
Logger::log('Notice message')->save();

// Save log as warning (Logger::LOG_LEVEL_WARN = 0)
Logger::log('Warning message', Logger::LOG_LEVEL_WARN)->save();

// Save log as fatal (Logger::LOG_LEVEL_FATAL = 2)
Logger::log('Fatal message', 2)->save();

// Save log as parse (Logger::LOG_LEVEL_PARSE = 3)
Logger::log('Parse message', 3)->save();

?>