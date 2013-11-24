<?php
/**
 * Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */

if (substr($_SERVER['DOCUMENT_ROOT'], - 1) == '/') {
    define('ROOT_FOLDER', $_SERVER['DOCUMENT_ROOT']);
} else {
    define('ROOT_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/');
}

$base = substr(__DIR__, 0, strlen(__DIR__) - 5);
define('BASE_FOLDER', $base);

$classMap = array(
    'Molajo\\Fieldhandler\\Adapter'                          => BASE_FOLDER . '/Adapter.php',
    'Molajo\\Fieldhandler\\CommonApi\\ExceptionInterface'          => BASE_FOLDER . '/Api/ExceptionInterface.php',
    'Molajo\\Fieldhandler\\CommonApi\\FieldhandlerInterface'       => BASE_FOLDER . '/Api/FieldhandlerInterface.php',
    'Molajo\\Fieldhandler\\Exception\\FieldhandlerException' => BASE_FOLDER . '/Exception/FieldhandlerException.php',
    'Molajo\\Fieldhandler\\Handler\\AbstractFieldhandler'    => BASE_FOLDER . '/Handler/AbstractFieldhandler.php',
    'Molajo\\Fieldhandler\\Handler\\Accepted'                => BASE_FOLDER . '/Handler/Accepted.php',
    'Molajo\\Fieldhandler\\Handler\\Alias'                   => BASE_FOLDER . '/Handler/Alias.php',
    'Molajo\\Fieldhandler\\Handler\\Alpha'                   => BASE_FOLDER . '/Handler/Alpha.php',
    'Molajo\\Fieldhandler\\Handler\\Alphanumeric'            => BASE_FOLDER . '/Handler/Alphanumeric.php',
    'Molajo\\Fieldhandler\\Handler\\Arrays'                  => BASE_FOLDER . '/Handler/Arrays.php',
    'Molajo\\Fieldhandler\\Handler\\Boolean'                 => BASE_FOLDER . '/Handler/Boolean.php',
    'Molajo\\Fieldhandler\\Handler\\Callback'                => BASE_FOLDER . '/Handler/Callback.php',
    'Molajo\\Fieldhandler\\Handler\\Contains'                => BASE_FOLDER . '/Handler/Contains.php',
    'Molajo\\Fieldhandler\\Handler\\Css'                     => BASE_FOLDER . '/Handler/Css.php',
    'Molajo\\Fieldhandler\\Handler\\Date'                    => BASE_FOLDER . '/Handler/Date.php',
    'Molajo\\Fieldhandler\\Handler\\Defaults'                => BASE_FOLDER . '/Handler/Defaults.php',
    'Molajo\\Fieldhandler\\Handler\\Digit'                   => BASE_FOLDER . '/Handler/Digit.php',
    'Molajo\\Fieldhandler\\Handler\\Email'                   => BASE_FOLDER . '/Handler/Email.php',
    'Molajo\\Fieldhandler\\Handler\\Encoded'                 => BASE_FOLDER . '/Handler/Encoded.php',
    'Molajo\\Fieldhandler\\Handler\\Equal'                   => BASE_FOLDER . '/Handler/Equal.php',
    'Molajo\\Fieldhandler\\Handler\\Extensions'              => BASE_FOLDER . '/Handler/Extensions.php',
    'Molajo\\Fieldhandler\\Handler\\Float'                   => BASE_FOLDER . '/Handler/Float.php',
    'Molajo\\Fieldhandler\\Handler\\Foreignkey'              => BASE_FOLDER . '/Handler/Foreignkey.php',
    'Molajo\\Fieldhandler\\Handler\\Fromto'                  => BASE_FOLDER . '/Handler/Fromto.php',
    'Molajo\\Fieldhandler\\Handler\\Fullspecialchars'        => BASE_FOLDER . '/Handler/Fullspecialchars.php',
    'Molajo\\Fieldhandler\\Handler\\Html'                    => BASE_FOLDER . '/Handler/Html.php',
    'Molajo\\Fieldhandler\\Handler\\Int'                     => BASE_FOLDER . '/Handler/Int.php',
    'Molajo\\Fieldhandler\\Handler\\Ip'                      => BASE_FOLDER . '/Handler/Ip.php',
    'Molajo\\Fieldhandler\\Handler\\Js'                      => BASE_FOLDER . '/Handler/Js.php',
    'Molajo\\Fieldhandler\\Handler\\Lower'                   => BASE_FOLDER . '/Handler/Lower.php',
    'Molajo\\Fieldhandler\\Handler\\Maximum'                 => BASE_FOLDER . '/Handler/Maximum.php',
    'Molajo\\Fieldhandler\\Handler\\Mimetypes'               => BASE_FOLDER . '/Handler/Mimetypes.php',
    'Molajo\\Fieldhandler\\Handler\\Minimum'                 => BASE_FOLDER . '/Handler/Minimum.php',
    'Molajo\\Fieldhandler\\Handler\\Notequal'                => BASE_FOLDER . '/Handler/Notequal.php',
    'Molajo\\Fieldhandler\\Handler\\Numeric'                 => BASE_FOLDER . '/Handler/Numeric.php',
    'Molajo\\Fieldhandler\\Handler\\Object'                  => BASE_FOLDER . '/Handler/Object.php',
    'Molajo\\Fieldhandler\\Handler\\Raw'                     => BASE_FOLDER . '/Handler/Raw.php',
    'Molajo\\Fieldhandler\\Handler\\Regex'                   => BASE_FOLDER . '/Handler/Regex.php',
    'Molajo\\Fieldhandler\\Handler\\Required'                => BASE_FOLDER . '/Handler/Required.php',
    'Molajo\\Fieldhandler\\Handler\\String'                  => BASE_FOLDER . '/Handler/String.php',
    'Molajo\\Fieldhandler\\Handler\\Time'                    => BASE_FOLDER . '/Handler/Time.php',
    'Molajo\\Fieldhandler\\Handler\\Trim'                    => BASE_FOLDER . '/Handler/Trim.php',
    'Molajo\\Fieldhandler\\Handler\\Upper'                   => BASE_FOLDER . '/Handler/Upper.php',
    'Molajo\\Fieldhandler\\Handler\\Url'                     => BASE_FOLDER . '/Handler/Url.php',
    'Molajo\\Fieldhandler\\Handler\\Values'                  => BASE_FOLDER . '/Handler/Values.php'
);

spl_autoload_register(
    function ($class) use ($classMap) {
        if (array_key_exists($class, $classMap)) {
            require_once $classMap[$class];
        }
    }
);
