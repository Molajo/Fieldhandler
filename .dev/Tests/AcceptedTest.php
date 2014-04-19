<?php
/**
 * Accepted Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;

/**
 * Accepted Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class AcceptedTest extends PHPUnit_Framework_TestCase
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
     * @return  void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $this->driver = new Driver();
    }

    /**
     * test Validate Success
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccess1()
    {
        $field_name              = 'Agreement';
        $field_value             = 122222;
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();
        $expected_message        = 'Field: Agreement does not have a valid value for Accepted data type.';

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $message = $results->getErrorMessages();
        $this->assertEquals($expected_message, $message[1000]);
        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * test Validate Success2
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccess2()
    {
        $field_name              = 'agreement';
        $field_value             = 'yes';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * test Validate Success 3
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccess3()
    {
        $field_name              = 'agreement';
        $field_value             = 'on';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * test Validate Success 4
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccess4()
    {
        $field_name              = 'agreement';
        $field_value             = true;
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * Test failure
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateUnsuccessful()
    {
        $field_name              = 'Agreement';
        $field_value             = 'nope';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();
        $expected_message        = 'Field: Agreement does not have a valid value for Accepted data type.';

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $message = $results->getErrorMessages();
        $this->assertEquals($expected_message, $message[1000]);
        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * test Filter Success
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterSuccess()
    {
        $field_name              = 'agreement';
        $field_value             = 'on';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('on', $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Default::filter
     *
     * @return void
     * @since   1.0.0
     */
    public function testFilterUnsuccessful()
    {
        $field_name              = 'agreement';
        $field_value             = 'noway';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(null, $results->getReturnValue());

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
        parent::tearDown();
    }
}
