<?php
/**
 * Callback FieldHandler Test
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
 * Callback FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class CallbackTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\FieldHandler\Handler\Callback::validate
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @return  void
     * @since   1.0
     */
    public function testValidate1()
    {
        $field_name              = 'attention';
        $field_value             = 'DOG';
        $fieldhandler_type_chain = 'Callback';
        $options                 = array();
        $options['callback']     = 'strtolower';

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = 'dog';
        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Callback::validate
     * @return  void
     * @since   1.0
     */
    public function testFilter1()
    {
        $field_name              = 'attention';
        $field_value             = 'DOG';
        $fieldhandler_type_chain = 'Callback';
        $options                 = array();
        $options['callback']     = 'strtolower';

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = 'dog';
        $this->assertEquals($field_value, $results);

        return;
    }
}
