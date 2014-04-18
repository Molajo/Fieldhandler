<?php
/**
 * Maximum Fieldhandler Test
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
 * Maximum Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class MaximumTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Adapter\Fromto::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name              = 'fieldname';
        $field_value             = 5;
        $fieldhandler_type_chain = 'Maximum';
        $options                 = array();
        $options['maximum']      = 10;

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Fromto::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateAlpha()
    {
        $field_name              = 'fieldname';
        $field_value             = 'a';
        $fieldhandler_type_chain = 'Maximum';
        $options                 = array();
        $options['maximum']      = 'z';

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Fromto::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name              = 'fieldname';
        $field_value             = 500;
        $fieldhandler_type_chain = 'Maximum';
        $options                 = array();
        $options['maximum']      = 10;

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

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
