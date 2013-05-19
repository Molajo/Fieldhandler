<?php
/**
 * FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */


if (substr($_SERVER['DOCUMENT_ROOT'], - 1) == '/') {
    define('ROOT_FOLDER', $_SERVER['DOCUMENT_ROOT']);
} else {
    define('ROOT_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/');
}

$base = substr(__DIR__, 0, strlen(__DIR__) - 5);
define('BASE_FOLDER', $base);

$classMap = array(
    'Molajo\\FieldHandler\\Adapter'                          => BASE_FOLDER . '/Adapter.php',
    'Molajo\\FieldHandler\\Api\\ExceptionInterface'          => BASE_FOLDER . '/Api/ExceptionInterface.php',
    'Molajo\\FieldHandler\\Api\\FieldHandlerInterface'       => BASE_FOLDER . '/Api/FieldHandlerInterface.php',
    'Molajo\\FieldHandler\\Exception\\FieldHandlerException' => BASE_FOLDER . '/Exception/FieldHandlerException.php',
    'Molajo\\FieldHandler\\Handler\\AbstractFieldHandler'    => BASE_FOLDER . '/Handler/AbstractFieldHandler.php',
    'Molajo\\FieldHandler\\Handler\\Accepted'                => BASE_FOLDER . '/Handler/Accepted.php',
    'Molajo\\FieldHandler\\Handler\\Alias'                   => BASE_FOLDER . '/Handler/Alias.php',
    'Molajo\\FieldHandler\\Handler\\Alpha'                   => BASE_FOLDER . '/Handler/Alpha.php',
    'Molajo\\FieldHandler\\Handler\\Alphanumeric'            => BASE_FOLDER . '/Handler/Alphanumeric.php',
    'Molajo\\FieldHandler\\Handler\\Arrays'                  => BASE_FOLDER . '/Handler/Arrays.php',
    'Molajo\\FieldHandler\\Handler\\Boolean'                 => BASE_FOLDER . '/Handler/Boolean.php',
    'Molajo\\FieldHandler\\Handler\\Callback'                => BASE_FOLDER . '/Handler/Callback.php',
    'Molajo\\FieldHandler\\Handler\\Contains'                => BASE_FOLDER . '/Handler/Contains.php',
    'Molajo\\FieldHandler\\Handler\\Css'                     => BASE_FOLDER . '/Handler/Css.php',
    'Molajo\\FieldHandler\\Handler\\Date'                    => BASE_FOLDER . '/Handler/Date.php',
    'Molajo\\FieldHandler\\Handler\\Defaults'                => BASE_FOLDER . '/Handler/Defaults.php',
    'Molajo\\FieldHandler\\Handler\\Digit'                   => BASE_FOLDER . '/Handler/Digit.php',
    'Molajo\\FieldHandler\\Handler\\Email'                   => BASE_FOLDER . '/Handler/Email.php',
    'Molajo\\FieldHandler\\Handler\\Encoded'                 => BASE_FOLDER . '/Handler/Encoded.php',
    'Molajo\\FieldHandler\\Handler\\Equal'                  => BASE_FOLDER . '/Handler/Equal.php',
    'Molajo\\FieldHandler\\Handler\\Extensions'              => BASE_FOLDER . '/Handler/Extensions.php',
    'Molajo\\FieldHandler\\Handler\\Float'                   => BASE_FOLDER . '/Handler/Float.php',
    'Molajo\\FieldHandler\\Handler\\Foreignkey'              => BASE_FOLDER . '/Handler/Foreignkey.php',
    'Molajo\\FieldHandler\\Handler\\Fromto'                  => BASE_FOLDER . '/Handler/Fromto.php',
    'Molajo\\FieldHandler\\Handler\\Fullspecialchars'        => BASE_FOLDER . '/Handler/Fullspecialchars.php',
    'Molajo\\FieldHandler\\Handler\\Html'                    => BASE_FOLDER . '/Handler/Html.php',
    'Molajo\\FieldHandler\\Handler\\Int'                     => BASE_FOLDER . '/Handler/Int.php',
    'Molajo\\FieldHandler\\Handler\\Ip'                      => BASE_FOLDER . '/Handler/Ip.php',
    'Molajo\\FieldHandler\\Handler\\Js'                      => BASE_FOLDER . '/Handler/Js.php',
    'Molajo\\FieldHandler\\Handler\\Lower'                   => BASE_FOLDER . '/Handler/Lower.php',
    'Molajo\\FieldHandler\\Handler\\Maximum'                 => BASE_FOLDER . '/Handler/Maximum.php',
    'Molajo\\FieldHandler\\Handler\\Mimetypes'               => BASE_FOLDER . '/Handler/Mimetypes.php',
    'Molajo\\FieldHandler\\Handler\\Minimum'                 => BASE_FOLDER . '/Handler/Minimum.php',
    'Molajo\\FieldHandler\\Handler\\Notequal'                => BASE_FOLDER . '/Handler/Notequal.php',
    'Molajo\\FieldHandler\\Handler\\Numeric'                 => BASE_FOLDER . '/Handler/Numeric.php',
    'Molajo\\FieldHandler\\Handler\\Object'                  => BASE_FOLDER . '/Handler/Object.php',
    'Molajo\\FieldHandler\\Handler\\Raw'                     => BASE_FOLDER . '/Handler/Raw.php',
    'Molajo\\FieldHandler\\Handler\\Regex'                   => BASE_FOLDER . '/Handler/Regex.php',
    'Molajo\\FieldHandler\\Handler\\Required'                => BASE_FOLDER . '/Handler/Required.php',
    'Molajo\\FieldHandler\\Handler\\String'                  => BASE_FOLDER . '/Handler/String.php',
    'Molajo\\FieldHandler\\Handler\\Time'                    => BASE_FOLDER . '/Handler/Time.php',
    'Molajo\\FieldHandler\\Handler\\Trim'                    => BASE_FOLDER . '/Handler/Trim.php',
    'Molajo\\FieldHandler\\Handler\\Upper'                   => BASE_FOLDER . '/Handler/Upper.php',
    'Molajo\\FieldHandler\\Handler\\Url'                     => BASE_FOLDER . '/Handler/Url.php',
    'Molajo\\FieldHandler\\Handler\\Values'                  => BASE_FOLDER . '/Handler/Values.php'
);

spl_autoload_register(
    function ($class) use ($classMap) {
        if (array_key_exists($class, $classMap)) {
            require_once $classMap[$class];
        }
    }
);
