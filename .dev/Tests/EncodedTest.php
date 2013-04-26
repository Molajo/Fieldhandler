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
use Molajo\FieldHandler\Exception\FieldHandlerException;

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
     * @covers  Molajo\FieldHandler\Handler\Encoded::validate
     * @return  void
     * @since   1.0
     */
    public function testValidateFail()
    {
        $field_name              = 'dog';
        $field_value             = 'my-apples&are green and red';
        $fieldhandler_type_chain = 'Encoded';
        $options                 = array();

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        return;
    }

    /**
     * @covers Molajo\FieldHandler\Handler\Encoded::validate
     * @return void
     * @since   1.0
     */
    public function testValidateSucceed()
    {
        $field_name              = 'dog';
        $field_value             = 'nothing';
        $fieldhandler_type_chain = 'Encoded';
        $options                 = array();

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Encoded::validate
     * @return  void
     * @since   1.0
     */
    public function testFilterSucceed()
    {
        $field_name              = 'dog';
        $field_value             = 'my-apples&are green and red';
        $fieldhandler_type_chain = 'Encoded';
        $options                 = array();

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = 'my-apples%26are%20green%20and%20red';
        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers Molajo\FieldHandler\Handler\Encoded::validate
     * @return void
     * @since   1.0
     */
    public function testFilterSucceed2()
    {
        $field_name              = 'dog';
        $field_value             = 'nothing';
        $fieldhandler_type_chain = 'Encoded';
        $options                 = array();

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

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
