<?php
/**
 * Bootstrap for Testing
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
$base = substr(__DIR__, 0, strlen(__DIR__) - 5);
if (function_exists('CreateClassMap')) {
} else {
    include_once __DIR__ . '/CreateClassMap.php';
}
include_once $base . '/vendor/autoload.php';

$classmap = array();
$results  = createClassMap($base . '/Source/Constraint/', 'Molajo\\Fieldhandler\\Constraint\\');
$classmap = array_merge($classmap, $results);
$results  = createClassMap($base . '/Source/Escape/', 'Molajo\\Fieldhandler\\Escape\\');
$classmap = array_merge($classmap, $results);

$classmap['Molajo\\Fieldhandler\\HandleResponse']   = $base . '/Source/HandleResponse.php';
$classmap['Molajo\\Fieldhandler\\ValidateResponse'] = $base . '/Source/ValidateResponse.php';
$classmap['Molajo\\Fieldhandler\\Message']          = $base . '/Source/Message.php';
$classmap['Molajo\\Fieldhandler\\Request']          = $base . '/Source/Request.php';
$classmap['Molajo\\Fieldhandler\\Escape']           = $base . '/Source/Escape.php';
ksort($classmap);

spl_autoload_register(
    function ($class) use ($classmap) {
        if (array_key_exists($class, $classmap)) {
            require_once $classmap[$class];
        }
    }
);
