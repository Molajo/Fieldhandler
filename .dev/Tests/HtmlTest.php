<?php
/**
 * HTML Fieldhandler Test
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
 * Fullspecialchars Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class HtmlTest extends PHPUnit_Framework_TestCase
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
     * Test HTML filter
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFilter()
    {
        $field_name              = 'fieldname';
        $field_value             = '<script>("Gotcha!");</script><p>I am fine.</p>';
        $fieldhandler_type_chain = 'Html';
        $filtered                = '("Gotcha!");<p>I am fine.</p>';

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, array());

        $this->assertEquals($filtered, $results->getReturnValue());

        return;
    }

    /**
     * Test Validate
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidate()
    {
        $field_name              = 'fieldname';
        $field_value             = '<p>Yup.</p>';
        $fieldhandler_type_chain = 'Html';

        $results = $this->driver->validate($field_name, $field_value, $fieldhandler_type_chain, array());

        $this->assertEquals(true, $results->getReturnValue());

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
