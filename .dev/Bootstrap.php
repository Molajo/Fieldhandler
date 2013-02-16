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

$classMap = array(
    'Molajo\\Filters\\Adapter'                     => BASE_FOLDER . '/Adapter.php',
    'Molajo\\Filters\\Adapter\\FilterInterface'    => BASE_FOLDER . '/Adapter/FilterInterface.php',
    'Molajo\\Filters\\Exception\\FilterException'  => BASE_FOLDER . '/Exception/FilterException.php',

    'Molajo\\Filters\\Type\\AbstractFilter'        => BASE_FOLDER . '/Type/AbstractFilter.php',
    'Molajo\\Filters\\Type\\Accepted'              => BASE_FOLDER . '/Type/Accepted.php',
    'Molajo\\Filters\\Type\\Alias'                 => BASE_FOLDER . '/Type/Alias.php',
    'Molajo\\Filters\\Type\\Alpha'                 => BASE_FOLDER . '/Type/Alpha.php',
    'Molajo\\Filters\\Type\\Alphanumeric'          => BASE_FOLDER . '/Type/Alphanumeric.php',
    'Molajo\\Filters\\Type\\Arrays'                => BASE_FOLDER . '/Type/Arrays.php',
    'Molajo\\Filters\\Type\\Boolean'               => BASE_FOLDER . '/Type/Boolean.php',
    'Molajo\\Filters\\Type\\Callback'              => BASE_FOLDER . '/Type/Callback.php',
    'Molajo\\Filters\\Type\\Date'                  => BASE_FOLDER . '/Type/Date.php',
    'Molajo\\Filters\\Type\\Defaults'              => BASE_FOLDER . '/Type/Defaults.php',
    'Molajo\\Filters\\Type\\Digit'                 => BASE_FOLDER . '/Type/Digit.php',
    'Molajo\\Filters\\Type\\Email'                 => BASE_FOLDER . '/Type/Email.php',
    'Molajo\\Filters\\Type\\Encoded'               => BASE_FOLDER . '/Type/Encoded.php',
    'Molajo\\Filters\\Type\\Equals'                => BASE_FOLDER . '/Type/Equals.php',
    'Molajo\\Filters\\Type\\Extensions'            => BASE_FOLDER . '/Type/Extensions.php',
    'Molajo\\Filters\\Type\\Float'                 => BASE_FOLDER . '/Type/Float.php',
    'Molajo\\Filters\\Type\\Fullspecialchars'      => BASE_FOLDER . '/Type/Fullspecialchars.php',
    'Molajo\\Filters\\Type\\Int'                   => BASE_FOLDER . '/Type/Int.php',
    'Molajo\\Filters\\Type\\Ip'                    => BASE_FOLDER . '/Type/Ip.php',
    'Molajo\\Filters\\Type\\Lower'                 => BASE_FOLDER . '/Type/Lower.php',
    'Molajo\\Filters\\Type\\Maximum'               => BASE_FOLDER . '/Type/Maximum.php',
    'Molajo\\Filters\\Type\\Mimetypes'             => BASE_FOLDER . '/Type/Mimetypes.php',
    'Molajo\\Filters\\Type\\Minimum'               => BASE_FOLDER . '/Type/Minimum.php',
    'Molajo\\Filters\\Type\\Numeric'               => BASE_FOLDER . '/Type/Numeric.php',
    'Molajo\\Filters\\Type\\Raw'                   => BASE_FOLDER . '/Type/Raw.php',
    'Molajo\\Filters\\Type\\Regex'                 => BASE_FOLDER . '/Type/Regex.php',
    'Molajo\\Filters\\Type\\Required'              => BASE_FOLDER . '/Type/Required.php',
    'Molajo\\Filters\\Type\\String'                => BASE_FOLDER . '/Type/String.php',
    'Molajo\\Filters\\Type\\Trim'                  => BASE_FOLDER . '/Type/Trim.php',
    'Molajo\\Filters\\Type\\Upper'                 => BASE_FOLDER . '/Type/Upper.php',
    'Molajo\\Filters\\Type\\Url'                   => BASE_FOLDER . '/Type/Url.php',
    'Molajo\\Filters\\Type\\Values'                => BASE_FOLDER . '/Type/Values.php',

    'Molajo\\Filters\\Tests\\Defaults'             => BASE_FOLDER . '/Tests/Classes/TestDefaults.php'
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
