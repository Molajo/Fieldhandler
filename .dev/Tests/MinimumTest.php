<?php
/**
 * Minimum FieldHandler Test
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
 * Minimum FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class MinimumTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\FieldHandler\Handler\Fromto::validate
     * @return  void
     * @since   1.0
     */
    public function testValidate1()
    {
        $field_name              = 'fieldname';
        $field_value             = 5;
        $fieldhandler_type_chain = 'Minimum';
        $options                 = array();
        $options['minimum']      = 1;

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Fromto::validate
     * @expectedException \Molajo\FieldHandler\Exception\FieldHandlerException
     * @return  void
     * @since   1.0
     */
    public function testValidateFail()
    {
        $field_name              = 'fieldname';
        $field_value             = 500;
        $fieldhandler_type_chain = 'Minimum';
        $options                 = array();
        $options['minimum']      = 1000000;

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

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

    }
}
