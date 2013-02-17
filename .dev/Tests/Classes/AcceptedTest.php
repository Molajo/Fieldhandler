<?php
/**
 * Accepted FieldHandler Test
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
 * Accepted FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class AcceptedTest extends PHPUnit_Framework_TestCase
{
    /**
     * Set up
     *
     * @return  void
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
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testValidateSuccess1()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'agreement';
        $field_value             = 1;
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(1, $adapter->field_value);

        return;
    }

    /**
     * test Validate Success2
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testValidateSuccess2()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'agreement';
        $field_value             = 'yes';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('yes', $adapter->field_value);

        return;
    }

    /**
     * test Validate Success 3
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testValidateSuccess3()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'agreement';
        $field_value             = 'on';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('on', $adapter->field_value);

        return;
    }

    /**
     * test Validate Success 4
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testValidateSuccess4()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'agreement';
        $field_value             = true;
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $adapter->field_value);

        return;
    }

    /**
     * @covers Molajo\FieldHandler\Type\Default::validate
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @return  void
     * @since   1.0
     */
    public function testValidateUnsuccessful()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'agreement';
        $field_value             = 'e';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(null, $adapter->field_value);

        return;
    }

    /**
     * Tear down
     *
     * @return  void
     * @since   1.0
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
