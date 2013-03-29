<?php
/**
 * FieldHandler
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
    'Molajo\\FieldHandler\\Adapter'                          => BASE_FOLDER . '/Adapter.php',
    'Molajo\\FieldHandler\\Adapter\\FieldHandlerInterface'   => BASE_FOLDER . '/Adapter/FieldHandlerInterface.php',
    'Molajo\\FieldHandler\\Exception\\FieldHandlerException' => BASE_FOLDER . '/Exception/FieldHandlerException.php',

    'Molajo\\FieldHandler\\Type\\AbstractFieldHandler'       => BASE_FOLDER . '/Type/AbstractFieldHandler.php',
    'Molajo\\FieldHandler\\Type\\Accepted'                   => BASE_FOLDER . '/Type/Accepted.php',
    'Molajo\\FieldHandler\\Type\\Alias'                      => BASE_FOLDER . '/Type/Alias.php',
    'Molajo\\FieldHandler\\Type\\Alpha'                      => BASE_FOLDER . '/Type/Alpha.php',
    'Molajo\\FieldHandler\\Type\\Alphanumeric'               => BASE_FOLDER . '/Type/Alphanumeric.php',
    'Molajo\\FieldHandler\\Type\\Arrays'                     => BASE_FOLDER . '/Type/Arrays.php',
    'Molajo\\FieldHandler\\Type\\Boolean'                    => BASE_FOLDER . '/Type/Boolean.php',
    'Molajo\\FieldHandler\\Type\\Callback'                   => BASE_FOLDER . '/Type/Callback.php',
    'Molajo\\FieldHandler\\Type\\Date'                       => BASE_FOLDER . '/Type/Date.php',
    'Molajo\\FieldHandler\\Type\\Defaults'                   => BASE_FOLDER . '/Type/Defaults.php',
    'Molajo\\FieldHandler\\Type\\Digit'                      => BASE_FOLDER . '/Type/Digit.php',
    'Molajo\\FieldHandler\\Type\\Email'                      => BASE_FOLDER . '/Type/Email.php',
    'Molajo\\FieldHandler\\Type\\Encoded'                    => BASE_FOLDER . '/Type/Encoded.php',
    'Molajo\\FieldHandler\\Type\\Equals'                     => BASE_FOLDER . '/Type/Equals.php',
    'Molajo\\FieldHandler\\Type\\Extensions'                 => BASE_FOLDER . '/Type/Extensions.php',
    'Molajo\\FieldHandler\\Type\\Float'                      => BASE_FOLDER . '/Type/Float.php',
    'Molajo\\FieldHandler\\Type\\Fullspecialchars'           => BASE_FOLDER . '/Type/Fullspecialchars.php',
    'Molajo\\FieldHandler\\Type\\Int'                        => BASE_FOLDER . '/Type/Int.php',
    'Molajo\\FieldHandler\\Type\\Ip'                         => BASE_FOLDER . '/Type/Ip.php',
    'Molajo\\FieldHandler\\Type\\Lower'                      => BASE_FOLDER . '/Type/Lower.php',
    'Molajo\\FieldHandler\\Type\\Maximum'                    => BASE_FOLDER . '/Type/Maximum.php',
    'Molajo\\FieldHandler\\Type\\Mimetypes'                  => BASE_FOLDER . '/Type/Mimetypes.php',
    'Molajo\\FieldHandler\\Type\\Minimum'                    => BASE_FOLDER . '/Type/Minimum.php',
    'Molajo\\FieldHandler\\Type\\Numeric'                    => BASE_FOLDER . '/Type/Numeric.php',
    'Molajo\\FieldHandler\\Type\\Raw'                        => BASE_FOLDER . '/Type/Raw.php',
    'Molajo\\FieldHandler\\Type\\Regex'                      => BASE_FOLDER . '/Type/Regex.php',
    'Molajo\\FieldHandler\\Type\\Required'                   => BASE_FOLDER . '/Type/Required.php',
    'Molajo\\FieldHandler\\Type\\String'                     => BASE_FOLDER . '/Type/String.php',
    'Molajo\\FieldHandler\\Type\\Trim'                       => BASE_FOLDER . '/Type/Trim.php',
    'Molajo\\FieldHandler\\Type\\Upper'                      => BASE_FOLDER . '/Type/Upper.php',
    'Molajo\\FieldHandler\\Type\\Url'                        => BASE_FOLDER . '/Type/Url.php',
    'Molajo\\FieldHandler\\Type\\Values'                     => BASE_FOLDER . '/Type/Values.php'
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
