<?php
/**
 * Url Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;

/**
 * Url Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class UrlTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Adapter\Url::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name              = 'url_field';
        $field_value             = 'http://google.com/';
        $fieldhandler_type_chain = 'Url';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Url::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name              = 'url_field';
        $field_value             = ' $-_.+!';
        $fieldhandler_type_chain = 'Url';
        $options                 = array();

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, $options);
        $this->assertEquals(false, $results->getReturnValue());
        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Url::validate
     * @return  void
     * @since   1.0.0
     */
    public function testFilter1()
    {
        $field_name              = 'url_field';
        $field_value             = 'http://google.com/';
        $fieldhandler_type_chain = 'Url';
        $options                 = array();

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Url::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterFail()
    {
        $field_name                            = 'url_field';
        $field_value                           = 'yessireebob';
        $fieldhandler_type_chain               = 'Url';
        $options                               = array();
        $options['FILTER_FLAG_PATH_REQUIRED']  = true;
        $options['FILTER_FLAG_QUERY_REQUIRED'] = true;

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(null, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Url::validate
     * @return  void
     * @since   1.0.0
     */
    public function testEscape1()
    {
        $field_name              = 'url_field';
        $field_value             = 'http://google.com/';
        $fieldhandler_type_chain = 'Url';
        $options                 = array();

        $results = $this->driver->escape($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Url::validate
     * @return void
     * @since   1.0.0
     */
    public function testEscapeFail()
    {
        $field_name                  = 'url_field';
        $field_value                 = 'yessireebob';
        $fieldhandler_type_chain     = 'Url';
        $options                     = array();
        $options['FILTER_FLAG_IPV6'] = true;

        $results = $this->driver->escape($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(null, $results->getReturnValue());

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
