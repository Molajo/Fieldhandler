<?php
/**
 * lower Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;

/**
 * lower Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class LowerTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\lower::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilter()
    {
        $field_name  = 'test';
        $field_value = 'aa123';
        $constraint  = 'lower';
        $options     = array();

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals('aa123', $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\lower::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'test';
        $field_value = 'Aa123';
        $constraint  = 'lower';
        $options     = array();

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\lower::filter
     * @return void
     * @since   1.0.0
     */
    public function testFilterValid()
    {
        $field_name  = 'test';
        $field_value = 'Aa123';
        $constraint  = 'lower';
        $options     = array();

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals('aa123', $results->getReturnValue());

        return;
    }
}
