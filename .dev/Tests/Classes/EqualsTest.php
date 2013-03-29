<?php
/**
 * Equals FieldHandler Test
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
 * Equals FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class EqualsTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testValidateSuccess()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'link';
        $field_value             = 'stuff';
        $fieldhandler_type_chain = 'Equals';
        $options                 = array('equals' => 'stuff');

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('stuff', $adapter->field_value);

        return;
    }

    /**
     * test Validate Failure
     *
     * @covers Molajo\FieldHandler\Type\Equals::validate
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @return void
     * @since   1.0
     */
    public function testValidateFailure()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'link';
        $field_value             = 'stuff';
        $fieldhandler_type_chain = 'Equals';
        $options                 = array('equals' => 'xyz');

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(null, $adapter->field_value);

        return;
    }

    /**
     * test Filter Success
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testFilterSuccess()
    {
        parent::setUp();

        $method                  = 'Filter';
        $field_name              = 'link';
        $field_value             = 'stuff';
        $fieldhandler_type_chain = 'Equals';
        $options                 = array('equals' => 'stuff');

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('stuff', $adapter->field_value);

        return;
    }

    /**
     * test Filter Success
     *
     * @covers Molajo\FieldHandler\Type\Equals::validate
     * @return void
     * @since   1.0
     */
    public function testFilterSuccess2()
    {
        parent::setUp();

        $method                  = 'Filter';
        $field_name              = 'link';
        $field_value             = 'stuff';
        $fieldhandler_type_chain = 'Equals';
        $options                 = array('equals' => 'xyz');

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(null, $adapter->field_value);

        return;
    }

    /**
     * test Escape Success
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testEscapeSuccess()
    {
        parent::setUp();

        $method                  = 'Escape';
        $field_name              = 'link';
        $field_value             = 'stuff';
        $fieldhandler_type_chain = 'Equals';
        $options                 = array('equals' => 'stuff');

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('stuff', $adapter->field_value);

        return;
    }

    /**
     * test Escape Success
     *
     * @covers Molajo\FieldHandler\Type\Equals::validate
     * @return void
     * @since   1.0
     */
    public function testEscapeSuccess2()
    {
        parent::setUp();

        $method                  = 'Escape';
        $field_name              = 'link';
        $field_value             = 'stuff';
        $fieldhandler_type_chain = 'Equals';
        $options                 = array('equals' => 'xyz');

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(null, $adapter->field_value);

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
