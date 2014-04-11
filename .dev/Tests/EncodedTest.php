<?php
/**
 * Encoded Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Encoded Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class EncodedTest extends PHPUnit_Framework_TestCase
{
    /**
     * Adapter
     *
     * @var    object  Molajo\Fieldhandler\Driver
     * @since  1.0
     */
    protected $driver;

    /**
     * Set up
     *
     * @return void
     * @since   1.0
     */
    protected function setUp()
    {
        $this->driver = new Driver();
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Encoded::validate
     * @expectedException \CommonApi\Exception\UnexpectedValueException
     * @since   1.0
     */
    public function testValidateFail()
    {
        $field_name              = 'dog';
        $field_value             = 'my-apples&are green and red';
        $fieldhandler_type_chain = 'Encoded';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Encoded::validate
     * @return  void
     * @since   1.0
     */
    public function testValidateSucceed()
    {
        $field_name              = 'dog';
        $field_value             = 'nothing';
        $fieldhandler_type_chain = 'Encoded';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Encoded::validate
     * @return  void
     * @since   1.0
     */
    public function testFilterSucceed()
    {
        $field_name              = 'dog';
        $field_value             = 'my-apples&are green and red';
        $fieldhandler_type_chain = 'Encoded';
        $options                 = array();

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = 'my-apples%26are%20green%20and%20red';
        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Encoded::validate
     * @return void
     * @since   1.0
     */
    public function testFilterSucceed2()
    {
        $field_name              = 'dog';
        $field_value             = 'nothing';
        $fieldhandler_type_chain = 'Encoded';
        $options                 = array();

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

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
