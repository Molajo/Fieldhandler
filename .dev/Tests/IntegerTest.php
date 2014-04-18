<?php
/**
 * Integer Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;

/**
 * Integer Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class IntegerTest extends PHPUnit_Framework_TestCase
{
    /**
     * Adapter
     *
     * @var    object  Molajo\Fieldhandler\Driver
     * @since  1.0.0
     */
    protected $driver;

    /**
     * Set up
     *
     * @return void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $this->driver = new Driver();
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Integer::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrue()
    {
        $field_name              = 'Integer_fieldname';
        $field_value             = 1;
        $fieldhandler_type_chain = 'Integer';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Integer::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name              = 'Integer_fieldname';
        $field_value             = 'i';
        $fieldhandler_type_chain = 'Integer';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Integer::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateNull()
    {
        $field_name              = 'Integer_fieldname';
        $field_value             = null;
        $fieldhandler_type_chain = 'Integer';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Integer::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name              = 'Integer_fieldname';
        $field_value             = 'yessireebob';
        $fieldhandler_type_chain = 'Integer';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(false, $results->getReturnValue());

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
