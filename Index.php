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

define('BASE_FOLDER', __DIR__);

include BASE_FOLDER . '/' . 'ClassLoader.php';
   echo  BASE_FOLDER . '/Src/Molajo/Filters';
$loader = new ClassLoader();
$loader->add('Molajo\\Filters', BASE_FOLDER . '/Src/Molajo/Filters');

echo '<pre>';

var_dump($loader);
