<?php
/**
 * String Fieldhandler Test
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
 * String Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class StringTest extends PHPUnit_Framework_TestCase
{
    /**
     * Adapter
     *
     * @var    object  Molajo\Fieldhandler\Driver
     * @since  1.0.0
     */
    protected $driver;

    /**
     * Set up
     *
     * @return void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $this->driver = new Driver();
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\String::validate
     * @return  void
     * @since   1.0.0
     */
    public function testEscape()
    {
        $field_name              = 'fieldname';
        $field_value             = '&';
        $fieldhandler_type_chain = 'String';

        $results = $this->driver->escape($field_name, $field_value, $fieldhandler_type_chain, array());

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\String::validate
     * @expectedException \CommonApi\Exception\UnexpectedValueException
     * @return  void
     * @since   1.0.0
     */
    public function testValidate()
    {
        $field_name              = 'fieldname';
        $field_value             = new \stdClass();
        $fieldhandler_type_chain = 'String';

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, array());

        return;
    }

    /**
     * Tear down
     *
     * @return void
     * @since   1.0.0
     */
    protected function tearDown()
    {
    }
}
