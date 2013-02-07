<?php
namespace Molajo\Filters;

/**
 * Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 */
include '../../../' . 'Index.php';

use Molajo\Filters\Adapter as filterAdapter;
$read = BASE_FOLDER . '/Tests/Data/test1.txt';
$adapter = new filterAdapter('Read', $read);

echo '<pre>';
echo var_dump($adapter->fs);
