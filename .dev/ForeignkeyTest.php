<?php
/**
 * Foreignkey Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

include __DIR__ . '/../../' . 'Database/.dev/Bootstrap.php';

use Molajo\Fieldhandler\Driver as Adapter;
use Molajo\Database\Adapter as Database;
use Molajo\Database\Adapter\Joomla;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Foreignkey Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class ForeignkeyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Adapter
     *
     * @var    object  Molajo/Fieldhandler/Adapter
     * @since  1.0
     */
    protected $adapter;

    /**
     * Database
     *
     * @var    object  Molajo/Database/Adapter
     * @since  1.0
     */
    protected $database;

    /**
     * Set up
     *
     * @return void
     * @since   1.0
     */
    protected function setUp()
    {
        $this->adapter = new Adapter();

        $options = array();

        $options['db_type']        = 'MySQLi';
        $options['db_host']        = 'localhost';
        $options['db_user']        = 'root';
        $options['db_password']    = 'root';
        $options['db_name']        = 'molajo';
        $options['db_prefix']      = 'molajo_';
        $options['process_events'] = 1;
        $options['select']         = true;

        $handler = new Joomla($options);

        $this->database = new Database($handler);
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Foreignkey::validate
     * @return  void
     * @since   1.0
     */
    public function testValidate1()
    {
        $field_name              = 'my_foreign_key';
        $field_value             = 1;
        $fieldhandler_type_chain = 'Foreignkey';
        $options                 = array();
        $options['database']     = $this->database;
        $options['table']        = 'molajo_actions';
        $options['key']          = 'id';

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Foreignkey::validate
     * @return void
     * @since   1.0
     */
    public function testEscapeFail()
    {
        $field_name              = 'my_foreign_key';
        $field_value             = 100000;
        $fieldhandler_type_chain = 'Foreignkey';
        $options                 = array();
        $options['database']     = $this->database;
        $options['table']        = 'molajo_actions';
        $options['key']          = 'id';

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * Tear down
     *
     * @return void
     * @since   1.0
     */
    protected function tearDown()
    {
    }
}
