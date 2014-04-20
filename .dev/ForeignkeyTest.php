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

use Molajo\Fieldhandler\Driver as Constraint;
use Molajo\Database\Constraint as Database;
use Molajo\Database\Constraint\Joomla;
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
     * Constraint
     *
     * @var    object  Molajo/Fieldhandler/Constraint
     * @since  1.0.0
     */
    protected $adapter;

    /**
     * Database
     *
     * @var    object  Molajo/Database/Constraint
     * @since  1.0.0
     */
    protected $database;

    /**
     * Set up
     *
     * @return void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $this->adapter = new Constraint();

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
     * @covers  Molajo\Fieldhandler\Constraint\Foreignkey::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name          = 'my_foreign_key';
        $field_value         = 1;
        $constraint          = 'Foreignkey';
        $options             = array();
        $options['database'] = $this->database;
        $options['table']    = 'molajo_actions';
        $options['key']      = 'id';

        $results = $this->adapter->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Foreignkey::validate
     * @return void
     * @since   1.0.0
     */
    public function testEscapeFail()
    {
        $field_name          = 'my_foreign_key';
        $field_value         = 100000;
        $constraint          = 'Foreignkey';
        $options             = array();
        $options['database'] = $this->database;
        $options['table']    = 'molajo_actions';
        $options['key']      = 'id';

        $results = $this->adapter->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * Tear down
     *
     * @return void
     * @since   1.0.0
     */
    protected function tearDown()
    {
    }
}
