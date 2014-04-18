<?php
/**
 * Arrays Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;

/**
 * Arrays Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class ArraysTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Adapter\Arrays::validate
     * @return void
     * @since   1.0.0
     */
    public function testValid()
    {
        $input   = array();
        $input[] = 1;
        $input[] = 2;

        $field_name              = 'test';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Arrays';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * test Validate Fail
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccess2()
    {
        $field_name              = 'alias';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Arrays';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * test Filter Success
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterSuccess()
    {
        $input   = array();
        $input[] = 1;
        $input[] = 2;

        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Arrays';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * test Filter Success 2
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterSuccess2()
    {
        $input   = array();
        $input[] = 'dog';

        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Arrays';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * test Filter Success 3
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterSuccess3()
    {
        $input   = array();
        $input[] = 'dog';
        $input[] = 'cat';

        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Arrays';

        $array_valid_values   = array();
        $array_valid_values[] = 'dog';
        $array_valid_values[] = 'cat';
        $array_valid_values[] = 'dogs';
        $array_valid_values[] = 'cats';
        $options              = array('array_valid_values' => $array_valid_values);

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * test Filter Fail 1
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterFail1()
    {
        $input   = array();
        $input[] = 'dog';
        $input[] = 'cat';

        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Arrays';

        $array_valid_values   = array();
        $array_valid_values[] = 'x';
        $array_valid_values[] = 'y';

        $options = array('array_valid_values' => $array_valid_values);

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * test Escape Success
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testEscapeSuccess()
    {
        $input   = array();
        $input[] = 1;
        $input[] = 2;

        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Arrays';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * test Escape Fail
     *
     * @covers  Molajo\Fieldhandler\Adapter\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testEscapeSuccess2()
    {
        $input   = array();
        $input[] = 'dog';

        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Arrays';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }
}
