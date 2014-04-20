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
     * Constraint
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
     * @covers  Molajo\Fieldhandler\Constraint\values::filter
     * @return  void
     * @since   1.0.0
     */
    public function testFilterValid()
    {
        $field_name                    = 'test';
        $field_value                   = 'a';
        $constraint                    = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals('a', $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\values::filter
     * @return  void
     * @since   1.0.0
     */
    public function testFilterFail()
    {
        $field_name                    = 'test';
        $field_value                   = 'z';
        $constraint                    = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\values::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name                    = 'test';
        $field_value                   = 'z';
        $constraint                    = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\values::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateValid()
    {
        $field_name                    = 'test';
        $field_value                   = 'a';
        $constraint                    = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }
}
