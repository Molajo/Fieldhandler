<?php
/**
 * Database Adapter
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */

include __DIR__ . '/Bootstrap.php';
include __DIR__ . '/../../' . 'Database/.dev/Bootstrap.php';

use Molajo\Fieldhandler\Adapter;

$adapter = new Adapter();

$options = array();

$options['db_type']        = 'MySQLi';
$options['db_host']        = 'localhost';
$options['db_user']        = 'root';
$options['db_password']    = 'root';
$options['db_name']        = 'molajo';
$options['db_prefix']      = 'molajo_';
$options['process_events'] = 1;
$options['select']         = true;

use Molajo\Database\Handler\Joomla;

$handler = new Joomla($options);

use Molajo\Database\Adapter as Database;

$database = new Database($handler);

$field_name              = 'my_foreign_key';
$field_value             = 1;
$fieldhandler_type_chain = 'Foreignkey';
$options                 = array();
$options['database']     = $database;
$options['table']        = 'molajo_actions';
$options['key']          = 'id';

$results = $adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

echo "Key should be 1: " . $results;
