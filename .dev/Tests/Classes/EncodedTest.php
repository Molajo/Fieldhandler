<?php
/**
 * Encoded FieldHandler Test
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
 * Encoded FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class EncodedTest extends PHPUnit_Framework_TestCase
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
        $field_value             = 'my-apples&are green and red';
        $fieldhandler_type_chain = 'Encoded';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('my-apples%26are%20green%20and%20red', $adapter->field_value);

        return;
    }

    /**
     * test Filter Success
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testFilterSuccess2()
    {
        parent::setUp();

        $method                  = 'Filter';
        $field_name              = 'link';
        $field_value             = 'maybe';
        $fieldhandler_type_chain = 'Encoded';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('maybe', $adapter->field_value);

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
        $field_value             = 'my-apples&are green and red';
        $fieldhandler_type_chain = 'Encoded';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('my-apples%26are%20green%20and%20red', $adapter->field_value);

        return;
    }

    /**
     * test Escape Success
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testEscapeSuccess2()
    {
        parent::setUp();

        $method                  = 'Escape';
        $field_name              = 'link';
        $field_value             = 'maybe';
        $fieldhandler_type_chain = 'Encoded';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('maybe', $adapter->field_value);

        return;
    }
}
