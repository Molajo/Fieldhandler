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
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::validate
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'dog';
        $field_value = 'my-apples&are green and red';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSucceed()
    {
        $field_name  = 'dog';
        $field_value = 'nothing';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::validate
     * @return  void
     * @since   1.0.0
     */
    public function testFilterSucceed()
    {
        $field_name  = 'dog';
        $field_value = 'my-apples&are green and red';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $field_value = 'my-apples%26are%20green%20and%20red';
        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterSucceed2()
    {
        $field_name  = 'dog';
        $field_value = 'nothing';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getReturnValue());

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
