<?php
/**
 * Minimum Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;

/**
 * Minimum Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class MinimumTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Fromto::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name         = 'fieldname';
        $field_value        = 5;
        $constraint         = 'Minimum';
        $options            = array();
        $options['minimum'] = 1;

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Fromto::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name         = 'fieldname';
        $field_value        = 500000000000000;
        $constraint         = 'Minimum';
        $options            = array();
        $options['minimum'] = 1000000;

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Fromto::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateAlpha()
    {
        $field_name         = 'fieldname';
        $field_value        = 'z';
        $constraint         = 'Minimum';
        $options            = array();
        $options['minimum'] = 'a';

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getReturnValue());

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
