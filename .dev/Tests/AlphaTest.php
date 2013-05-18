<?php
/**
 * Alpha FieldHandler Test
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Tests;



use Molajo\FieldHandler\Adapter as adapter;
use PHPUnit_Framework_TestCase;

/**
 * Alpha FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class AlphaTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\FieldHandler\Handler\Alpha::validate
     * @return void
     * @since   1.0
     */
    public function testValid()
    {
        $field_name              = 'test';
        $field_value             = 'AbCdEfG';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Alpha::validate
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @return void
     * @since   1.0
     */
    public function testValidateFail()
    {
        $field_name              = 'test';
        $field_value             = '@Aa123';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Alpha::filter
     * @return void
     * @since   1.0
     */
    public function testFilterValid()
    {
        $field_name              = 'test';
        $field_value             = 'AbCdEfG';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Alpha::filter
     * @return void
     * @since   1.0
     */
    public function testFilterFail()
    {
        $field_name              = 'test';
        $field_value             = '@Aa123';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = 'Aa';
        $this->assertEquals($field_value, $results);

        return;
    }


    /**
     * @covers  Molajo\FieldHandler\Handler\Alpha::filter
     * @return void
     * @since   1.0
     */
    public function testEscapeValid()
    {
        $field_name              = 'test';
        $field_value             = 'AbCdEfG';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $results = $this->adapter->escape($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Alpha::filter
     * @return void
     * @since   1.0
     */
    public function testEscapeFail()
    {
        $field_name              = 'test';
        $field_value             = 'Aa';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $results = $this->adapter->escape($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = 'Aa';
        $this->assertEquals($field_value, $results);

        return;
    }
}
