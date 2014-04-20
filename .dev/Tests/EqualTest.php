<?php
/**
 * Equal Fieldhandler Test
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
 * Equal Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class EqualTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Equals::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name        = 'field1';
        $field_value       = 'dog';
        $constraint        = 'Equal';
        $options           = array();
        $options['equals'] = 'dog';

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name        = 'field1';
        $field_value       = 'dog';
        $constraint        = 'Equal';
        $options           = array();
        $options['equals'] = 'cat';

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::filter
     * @return  void
     * @since   1.0.0
     */
    public function testFilter1()
    {
        $field_name        = 'field1';
        $field_value       = 'dog';
        $constraint        = 'Equal';
        $options           = array();
        $options['equals'] = 'dog';

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::filter
     * @return void
     * @since   1.0.0
     */
    public function testFilterFail()
    {
        $field_name        = 'field1';
        $field_value       = 'dog';
        $constraint        = 'Equal';
        $options           = array();
        $options['equals'] = 'cat';

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::escape
     * @return  void
     * @since   1.0.0
     */
    public function testEscape1()
    {
        $field_name        = 'field1';
        $field_value       = 'dog';
        $constraint        = 'Equal';
        $options           = array();
        $options['equals'] = 'dog';

        $results = $this->driver->escape($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::escape
     * @return void
     * @since   1.0.0
     */
    public function testEscapeFail()
    {
        $field_name        = 'field1';
        $field_value       = 'dog';
        $constraint        = 'Equal';
        $options           = array();
        $options['equals'] = 'cat';

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }
}
