<?php
/**
 * Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
include_once __DIR__ . '/CreateClassMap.php';

$base                                      = substr(__DIR__, 0, strlen(__DIR__) - 5);
$classmap                                  = array();
$classmap                                  = createClassMap($base . '/vendor/commonapi/model', 'CommonApi\\Model\\');
$results                                   = createClassMap(
    $base . '/vendor/commonapi/exception',
    'CommonApi\\Exception\\'
);
$classmap                                  = array_merge($classmap, $results);
$results                                   = createClassMap($base . '/Handler', 'Molajo\\Fieldhandler\\Handler\\');
$classmap                                  = array_merge($classmap, $results);
$classmap['Molajo\\Fieldhandler\\Adapter'] = $base . '/Adapter.php';
ksort($classmap);

spl_autoload_register(
    function ($class) use ($classmap) {
        if (array_key_exists($class, $classmap)) {
            require_once $classmap[$class];
        }
    }
);
