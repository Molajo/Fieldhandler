<?php
/**
 * Equal FieldHandler Test
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Tests;

use Molajo\FieldHandler\Adapter as adapter;
use PHPUnit_Framework_TestCase;
use Molajo\FieldHandler\Exception\FieldHandlerException;

/**
 * Equal FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class EqualTest extends PHPUnit_Framework_TestCase
{
    /**
     * Adapter
     *
     * @var    object  Molajo/Molajo/Adapter
     * @since  1.0
     */
    protected $adapter;

    /**
     * Set up
     *
     * @return void
     * @since   1.0
     */
    protected function setUp()
    {
        $this->adapter = new adapter();
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Equals::validate
     * @return  void
     * @since   1.0
     */
    public function testValidate1()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Equal';
        $options                 = array();
        $options['equals']       = 'dog';

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Equals::validate
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @return void
     * @since   1.0
     */
    public function testValidateFail()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Equal';
        $options                 = array();
        $options['equals']       = 'cat';

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Equals::filter
     * @return  void
     * @since   1.0
     */
    public function testFilter1()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Equal';
        $options                 = array();
        $options['equals']       = 'dog';

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Equals::filter
     * @return void
     * @since   1.0
     */
    public function testFilterFail()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Equal';
        $options                 = array();
        $options['equals']       = 'cat';

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Equals::escape
     * @return  void
     * @since   1.0
     */
    public function testEscape1()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Equal';
        $options                 = array();
        $options['equals']       = 'dog';

        $results = $this->adapter->escape($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Equals::escape
     * @return void
     * @since   1.0
     */
    public function testEscapeFail()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Equal';
        $options                 = array();
        $options['equals']       = 'cat';

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results);

        return;
    }
}
