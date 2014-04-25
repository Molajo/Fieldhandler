<?php
/**
 * Automate User Doc
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */

include __DIR__ . '/Bootstrap.php';

$base_path   = substr(__DIR__, 0, strlen(__DIR__) - 5);

$class = 'Molajo\\Reflection\\Source';
$source = new $class();
$data = $source->process($base_path, $classmap);

echo '<pre>';
var_dump($data);


//include __DIR__ . '/DDRender.php';

/**
 * $parse_mask = '#Parameter (.*) ]#iU';
 *
 * preg_match_all($parse_mask, $properties, $matches);
 *
 * if (count($matches) == 0) {
 * } else {
 * echo $i = 0;
 * foreach ($matches[1] as $parsed_token) {
 * echo $i ++ . '<br>';
 * echo '<pre>';
 * var_dump($parsed_token);
 * }
 * }
 */
