<?php
/**
 * Digit FieldHandler Test
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Tests;

defined('MOLAJO') or die;

use Molajo\FieldHandler\Adapter as adapter;

use PHPUnit_Framework_TestCase;

/**
 * Digit FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class DigitTest extends PHPUnit_Framework_TestCase
{
    /**
     * Set up
     *
     * @return void
     * @since   1.0
     */
    protected function setUp()
    {
        parent::setUp();

        return;
    }

    /**
     * test Validate Success
     *
     * @covers  Molajo\FieldHandler\Handler\Default::validate
     * @return void
     * @since   1.0
     */
    public function testValidateSuccess()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'alias';
        $field_value             = '1234';
        $fieldhandler_type_chain = 'Digit';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('1234', $adapter->field_value);

        return;
    }

    /**
     * test Validate Failure
     *
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @covers  Molajo\FieldHandler\Handler\Default::validate
     * @return void
     * @since   1.0
     */
    public function testValidateFailure()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'alias';
        $field_value             = 'abc123';
        $fieldhandler_type_chain = 'Digit';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        return;
    }

    /**
     * test Filter Success
     *
     * @covers  Molajo\FieldHandler\Handler\Default::validate
     * @return void
     * @since   1.0
     */
    public function testFilterSuccess()
    {
        parent::setUp();

        $method                  = 'Filter';
        $field_name              = 'alias';
        $field_value             = '1234';
        $fieldhandler_type_chain = 'Digit';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('1234', $adapter->field_value);

        return;
    }

    /**
     * test Filter Success 2
     *
     * @covers  Molajo\FieldHandler\Handler\Default::validate
     * @return void
     * @since   1.0
     */
    public function testFilterSuccess2()
    {
        parent::setUp();

        $method                  = 'Filter';
        $field_name              = 'alias';
        $field_value             = 'abc123';
        $fieldhandler_type_chain = 'Digit';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('123', $adapter->field_value);

        return;
    }

    /**
     * test Escape Success
     *
     * @covers  Molajo\FieldHandler\Handler\Default::validate
     * @return void
     * @since   1.0
     */
    public function testEscapeSuccess()
    {
        parent::setUp();

        $method                  = 'Escape';
        $field_name              = 'alias';
        $field_value             = '1234';
        $fieldhandler_type_chain = 'Digit';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('1234', $adapter->field_value);

        return;
    }

    /**
     * test Escape Success 2
     *
     * @covers  Molajo\FieldHandler\Handler\Default::validate
     * @return void
     * @since   1.0
     */
    public function testEscapeSuccess2()
    {
        parent::setUp();

        $method                  = 'Escape';
        $field_name              = 'alias';
        $field_value             = 'abc123';
        $fieldhandler_type_chain = 'Digit';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('123', $adapter->field_value);

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
        parent::tearDown();
    }
}
