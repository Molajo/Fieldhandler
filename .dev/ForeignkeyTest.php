<?php
/**
 * Foreignkey Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
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
     * Request
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
        $this->adapter = new Request();

        $this->database = new MockDB();
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

        $this->assertEquals($field_value, $results->getValidateResponse());

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

        $this->assertEquals($field_value, $results->getValidateResponse());

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

class MockDB
{

}
