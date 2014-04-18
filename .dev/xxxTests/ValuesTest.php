<?php
/**
 * Values Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;

/**
 * Values Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class ValuesTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Adapter\upper::validate
     * @return void
     * @since   1.0.0
     */
    public function testValid()
    {
        $field_name                    = 'test';
        $field_value                   = 'a';
        $fieldhandler_type_chain       = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($results, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\upper::validate
     * @expectedException \CommonApi\Exception\UnexpectedValueException
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name                    = 'test';
        $field_value                   = 'z';
        $fieldhandler_type_chain       = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\upper::filter
     * @return void
     * @since   1.0.0
     */
    public function testFilterValid()
    {
        $field_name                    = 'test';
        $field_value                   = 'z';
        $fieldhandler_type_chain       = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(null, $results);

        return;
    }
}
