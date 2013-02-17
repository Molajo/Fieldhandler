<?php
/**
 * Boolean FieldHandler Test
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
 * Boolean FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class BooleanTest extends PHPUnit_Framework_TestCase
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
        $field_value             = false;
        $fieldhandler_type_chain = 'Boolean';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(false, $adapter->field_value);

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
        $field_value             = true;
        $fieldhandler_type_chain = 'Boolean';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $adapter->field_value);

        return;
    }

    /**
     * test Validate Success1
     *
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testValidateFail1()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'agreement';
        $field_value             = 'yessireebob';
        $fieldhandler_type_chain = 'Boolean';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        return;
    }

    /**
     * test Validate Success3
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
        $field_value             =  null;
        $fieldhandler_type_chain = 'Boolean';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(null, $adapter->field_value);

        return;
    }


    /**
     * test Validate Success2
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testFilterSuccess1()
    {
        parent::setUp();

        $method                  = 'Filter';
        $field_name              = 'agreement';
        $field_value             = true;
        $fieldhandler_type_chain = 'Boolean';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $adapter->field_value);

        return;
    }

    /**
     * test Filter Success 2
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testFilterFail1()
    {
        parent::setUp();

        $input  = 'yessireebob';

        $method                  = 'Filter';
        $field_name              = 'agreement';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Boolean';
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
