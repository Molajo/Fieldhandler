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

$adapter = new filterAdapter();
$value = $adapter->filterInput('int', 5, $null = 1, $default = 0);
echo $value;
