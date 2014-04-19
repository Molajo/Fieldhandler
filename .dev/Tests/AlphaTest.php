<?php
/**
 * Alpha Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;

/**
 * Alpha Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class AlphaTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Adapter\Alpha::validate
     * @return void
     * @since   1.0.0
     */
    public function testValid()
    {
        $field_name              = 'test';
        $field_value             = 'AbCdEfG';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Alpha::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name              = 'test';
        $field_value             = '@Aa123';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(false, $results->getReturnValue());

        $expected_message        = 'Field: test must only contain Alpha values.';
        $message = $results->getErrorMessages();
        $this->assertEquals($expected_message, $message[2000]);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Alpha::filter
     * @return void
     * @since   1.0.0
     */
    public function testFilterValid()
    {
        $field_name              = 'test';
        $field_value             = 'AbCdEfG';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Alpha::filter
     * @return void
     * @since   1.0.0
     */
    public function testFilterFail()
    {
        $field_name              = 'test';
        $field_value             = '@Aa123';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = 'Aa';
        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Alpha::filter
     * @return void
     * @since   1.0.0
     */
    public function testEscapeValid()
    {
        $field_name              = 'test';
        $field_value             = 'AbCdEfG';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $results = $this->driver->escape($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Alpha::filter
     * @return void
     * @since   1.0.0
     */
    public function testEscapeFail()
    {
        $field_name              = 'test';
        $field_value             = 'Aa';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $results = $this->driver->escape($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = 'Aa';
        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }
}
