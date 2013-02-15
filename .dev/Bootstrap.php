<?php
/**
 * Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
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
    'Molajo\\Filters\\Adapter'                     => BASE_FOLDER . '/Adapter.php',
    'Molajo\\Filters\\Adapter\\FilterInterface'    => BASE_FOLDER . '/Adapter/FilterInterface.php',
    'Molajo\\Filters\\Exception\\FiltersException' => BASE_FOLDER . '/Exception/FiltersException.php',
    'Molajo\\Filters\\Type\\Alias'                 => BASE_FOLDER . '/Type/Alias.php',
    'Molajo\\Filters\\Type\\Alnum'                 => BASE_FOLDER . '/Type/Alnum.php',
    'Molajo\\Filters\\Type\\Alpha'                 => BASE_FOLDER . '/Type/Alpha.php',
    'Molajo\\Filters\\Type\\Array'                 => BASE_FOLDER . '/Type/Array.php',
    'Molajo\\Filters\\Type\\Boolean'               => BASE_FOLDER . '/Type/Boolean.php',
    'Molajo\\Filters\\Type\\Callback'              => BASE_FOLDER . '/Type/Callback.php',
    'Molajo\\Filters\\Type\\Command'               => BASE_FOLDER . '/Type/Command.php',
    'Molajo\\Filters\\Type\\Date'                  => BASE_FOLDER . '/Type/Date.php',
    'Molajo\\Filters\\Type\\Email'                 => BASE_FOLDER . '/Type/Email.php',
    'Molajo\\Filters\\Type\\File'                  => BASE_FOLDER . '/Type/File.php',
    'Molajo\\Filters\\Type\\Filename'              => BASE_FOLDER . '/Type/Filename.php',
    'Molajo\\Filters\\Type\\Float'                 => BASE_FOLDER . '/Type/Float.php',
    'Molajo\\Filters\\Type\\Folder'                => BASE_FOLDER . '/Type/Folder.php',
    'Molajo\\Filters\\Type\\Foldername'            => BASE_FOLDER . '/Type/Foldername.php',
    'Molajo\\Filters\\Type\\Html'                  => BASE_FOLDER . '/Type/Html.php',
    'Molajo\\Filters\\Type\\Int'                   => BASE_FOLDER . '/Type/Int.php',
    'Molajo\\Filters\\Type\\Ip'                    => BASE_FOLDER . '/Type/Ip.php',
    'Molajo\\Filters\\Type\\Link'                  => BASE_FOLDER . '/Type/Link.php',
    'Molajo\\Filters\\Type\\Linktext'              => BASE_FOLDER . '/Type/Linktext.php',
    'Molajo\\Filters\\Type\\Numeric'               => BASE_FOLDER . '/Type/Numeric.php',
    'Molajo\\Filters\\Type\\Raw'                   => BASE_FOLDER . '/Type/Raw.php',
    'Molajo\\Filters\\Type\\Regex'                 => BASE_FOLDER . '/Type/Regex.php',
    'Molajo\\Filters\\Type\\String'                => BASE_FOLDER . '/Type/String.php',
    'Molajo\\Filters\\Type\\Url'                   => BASE_FOLDER . '/Type/Url.php',
    'Molajo\\Filters\\Type\\Values'                => BASE_FOLDER . '/Type/Values.php',
    'Molajo\\Filters\\Type\\Word'                  => BASE_FOLDER . '/Type/Word.php',
    'Testcase1\\TestArrayFilter'                   => BASE_FOLDER . '/.dev/Tests/TestArrayFilter.php',
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
