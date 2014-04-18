<?php
/**
 * Alias Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as Adapter;
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
        $this->driver = new Adapter();
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Alias::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name              = 'alias';
        $field_value             = 'Jack and Jill';
        $fieldhandler_type_chain = 'Alias';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(false, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Alias::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValid()
    {
        $field_name              = 'alias';
        $field_value             = 'jack-and-jill';
        $fieldhandler_type_chain = 'Alias';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Alias::filter
     * @return void
     * @since   1.0.0
     */
    public function testFilterSucceed2()
    {
        $field_name              = 'alias';
        $field_value             = 'Jack and Jill';
        $fieldhandler_type_chain = 'Alias';
        $options                 = array();

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('jack-and-jill', $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Alias::escape
     * @return void
     * @since   1.0.0
     */
    public function testEscapeSucceed3()
    {
        $field_name              = 'alias';
        $field_value             = 'Jack *&and+Jill';
        $fieldhandler_type_chain = 'Alias';
        $options                 = array();

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

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
