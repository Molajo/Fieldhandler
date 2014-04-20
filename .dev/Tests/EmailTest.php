<?php
/**
 * Email Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;

/**
 * Email Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class EmailTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Email::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name  = 'email_address';
        $field_value = 'AmyStephen@Molajo.org';
        $constraint  = 'Email';
        $options     = array();

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Email::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'email_address';
        $field_value = 'yessireebob';
        $constraint  = 'Email';
        $options     = array();

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Email::filter
     * @return  void
     * @since   1.0.0
     */
    public function testFilter1()
    {
        $field_name  = 'email_address';
        $field_value = 'AmyStephen@Molajo.org';
        $constraint  = 'Email';
        $options     = array();

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Email::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterFail()
    {
        $field_name  = 'email_address';
        $field_value = 'yessireebob';
        $constraint  = 'Email';
        $options     = array();

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Email::validate
     * @return  void
     * @since   1.0.0
     */
    public function testEscape1()
    {
        $field_name  = 'email_address';
        $field_value = 'AmyStephen@Molajo.org';
        $constraint  = 'Email';
        $options     = array();

        $results = $this->driver->escape($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Email::validate
     * @return void
     * @since   1.0.0
     */
    public function testEscapeFail()
    {
        $field_name  = 'email_address';
        $field_value = 'yessireebob';
        $constraint  = 'Email';
        $options     = array();

        $results = $this->driver->escape($field_name, $field_value, $constraint, $options);

        $field_value = null;
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
