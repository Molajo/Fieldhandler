<?php
/**
 * Raw Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;

/**
 * Raw Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class RawTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Adapter\Raws::escape
     * @return void
     * @since   1.0.0
     */
    public function testEscapeFail()
    {
        $field_name                        = 'field1';
        $field_value                       = '&';
        $fieldhandler_type_chain           = 'Raw';
        $options                           = array();
        $options['FILTER_FLAG_ENCODE_AMP'] = true;

        $results = $this->driver->filter($field_name, $field_value, $fieldhandler_type_chain, $options);


        if (PHP_VERSION_ID > 50400) {
            $this->assertEquals('&', $results->getReturnValue());
        } else {
            $this->assertEquals('&amp;', $results->getReturnValue());
        }

        return;
    }
}
