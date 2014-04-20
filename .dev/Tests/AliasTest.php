<?php
/**
 * Alias Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as Constraint;
use PHPUnit_Framework_TestCase;

/**
 * Alias Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class AliasTest extends PHPUnit_Framework_TestCase
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
        $this->driver = new Constraint();
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alias::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'alias';
        $field_value = 'Jack and Jill';
        $constraint  = 'Alias';
        $options     = array();

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getReturnValue());

        $expected_message = 'Field: alias does not have a valid value for Alias data type.';
        $message          = $results->getErrorMessages();
        $this->assertEquals($expected_message, $message[1000]);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alias::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValid()
    {
        $field_name  = 'alias';
        $field_value = 'jack-and-jill';
        $constraint  = 'Alias';
        $options     = array();

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alias::filter
     * @return void
     * @since   1.0.0
     */
    public function testFilterSucceed2()
    {
        $field_name  = 'alias';
        $field_value = 'Jack and Jill';
        $constraint  = 'Alias';
        $options     = array();

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals('jack-and-jill', $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alias::escape
     * @return void
     * @since   1.0.0
     */
    public function testEscapeSucceed3()
    {
        $field_name  = 'alias';
        $field_value = 'Jack *&and+Jill';
        $constraint  = 'Alias';
        $options     = array();

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals('jack-and-jill', $results->getReturnValue());

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
