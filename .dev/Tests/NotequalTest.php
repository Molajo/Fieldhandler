<?php
/**
 * Notequal Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as adapter;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Notequal Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class NotequalTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Adapter\Equals::validate
     * @return  void
     * @since   1.0
     */
    public function testValidate1()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Notequal';
        $options                 = array();
        $options['not_equal']    = 'cat';

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Equals::validate
     * @expectedException CommonApi\Exception\UnexpectedValueException
     * @return void
     * @since   1.0
     */
    public function testValidateFail()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Notequal';
        $options                 = array();
        $options['not_equal']    = 'dog';

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Equals::filter
     * @return  void
     * @since   1.0
     */
    public function testFilter1()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Notequal';
        $options                 = array();
        $options['not_equal']    = 'cat';

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Equals::filter
     * @return void
     * @since   1.0
     */
    public function testFilterFail()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Notequal';
        $options                 = array();
        $options['not_equal']    = 'dog';

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Equals::escape
     * @return  void
     * @since   1.0
     */
    public function testEscape1()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Notequal';
        $options                 = array();
        $options['not_equal']    = 'cat';

        $results = $this->adapter->escape($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Equals::escape
     * @return void
     * @since   1.0
     */
    public function testEscapeFail()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Notequal';
        $options                 = array();
        $options['not_equal']    = 'dog';

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results);

        return;
    }
}
