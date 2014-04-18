<?php
/**
 * Trim Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;

/**
 * Trim Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class TrimTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Adapter\Trim::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name              = 'req';
        $field_value             = 'AmyStephen@Molajo.org';
        $fieldhandler_type_chain = 'Trim';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Trim::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name              = 'email';
        $field_value             = 'AmyStephen@Molajo.org                ';
        $fieldhandler_type_chain = 'Trim';

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, array());

        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Trim::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFilter()
    {
        $field_name              = 'req';
        $field_value             = '            AmyStephen@Molajo.org           ';
        $fieldhandler_type_chain = 'Trim';
        $options                 = array();

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('AmyStephen@Molajo.org', $results->getReturnValue());

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
