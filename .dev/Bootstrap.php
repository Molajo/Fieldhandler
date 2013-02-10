<?php
/**
 * Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 */
define('MOLAJO', 'This is a Molajo Distribution');

if (substr($_SERVER['DOCUMENT_ROOT'], - 1) == '/') {
    define('ROOT_FOLDER', $_SERVER['DOCUMENT_ROOT']);
} else {
    define('ROOT_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/');
}

$base = substr(__DIR__, 0, strlen(__DIR__) - 5);
define('BASE_FOLDER', $base);

//include BASE_FOLDER . '/Tests/Testcase1/Data.php';

$classMap = array(
    'Molajo\\Filters\\Adapter'                                 => BASE_FOLDER . '/Adapter.php',
    'Molajo\\Filters\\Adapter\\FiltersActionsInterface'     => BASE_FOLDER . '/Adapter/FiltersActionsInterface.php',
    'Molajo\\Filters\\Adapter\\FilterInterface'            => BASE_FOLDER . '/Adapter/FilterInterface.php',
    'Molajo\\Filters\\Adapter\\Fileupload'                     => BASE_FOLDER . '/Adapter/Fileupload.php',
    'Molajo\\Filters\\Adapter\\MetadataInterface'              => BASE_FOLDER . '/Adapter/MetadataInterface.php',
    'Molajo\\Filters\\Adapter\\SystemInterface'                => BASE_FOLDER . '/Adapter/SystemInterface.php',
    'Molajo\\Filters\\Exception\\AccessDeniedException'        => BASE_FOLDER . '/Exception/AccessDeniedException.php',
    'Molajo\\Filters\\Exception\\FiltersException'          => BASE_FOLDER . '/Exception/FiltersException.php',
    'Molajo\\Filters\\Exception\\FiltersExceptionInterface' => BASE_FOLDER . '/Exception/FiltersExceptionInterface.php',
    'Molajo\\Filters\\Exception\\NotFoundException'            => BASE_FOLDER . '/Exception/NotFoundException.php',
    'Molajo\\Filters\\Type\\Testcase1'                             => BASE_FOLDER . '/Type/Testcase1.php',
    'Molajo\\Filters\\Type\\FiltersProperties'              => BASE_FOLDER . '/Type/FiltersProperties.php',

    'Testcase1\\Data'                                                 => BASE_FOLDER . '/.dev/Tests/Testcase1/Data.php',
    'Testcase1\\Testcase1CopyTest'                                        => BASE_FOLDER . '/.dev/Tests/Testcase1/Testcase1CopyTest.php',
    'Testcase1\\Testcase1DeleteTest'                                      => BASE_FOLDER . '/.dev/Tests/Testcase1/Testcase1DeleteTest.php',
    'Testcase1\\Testcase1MoveTest'                                        => BASE_FOLDER . '/.dev/Tests/Testcase1/Testcase1MoveTest.php',
    'Testcase1\\Testcase1ReadTest'                                        => BASE_FOLDER . '/.dev/Tests/Testcase1/Testcase1ReadTest.php',
    'Testcase1\\Testcase1WriteTest'                                       => BASE_FOLDER . '/.dev/Tests/Testcase1/Testcase1WriteTest.php'
);

spl_autoload_register(
    function ($class) use ($classMap) {
        if (array_key_exists($class, $classMap)) {
            require_once $classMap[$class];
        }
    }
);

/*
include BASE_FOLDER . '/' . 'ClassLoader.php';
$loader = new ClassLoader();
$loader->add('Molajo', BASE_FOLDER . '/src/');
$loader->add('Testcase1', BASE_FOLDER . '/Tests/');
$loader->register();
*/
