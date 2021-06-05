# Logger
Simple logger

## Install

`composer require alonity/logger`

### Examples
```php
use alonity\logger\Logger;

require('vendor/autoload.php');

Logger::log('Notice message')->save(); // Log saved to ../../../../tmp/logs/notice.php
```