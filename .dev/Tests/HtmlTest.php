<?php
/**
 * Fullspecialchars Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as adapter;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Fullspecialchars Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class HtmlTest extends PHPUnit_Framework_TestCase
{
    /**
     * Adapter
     *
     * @var    object  Molajo/Molajo/Adapter
     * @since  1.0
     */
    protected $adapter;

    /**
     * Set up
     *
     * @return void
     * @since   1.0
     */
    protected function setUp()
    {
        $this->adapter = new adapter();
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Fullspecialchars::validate
     * @return  void
     * @since   1.0
     */
    public function testEscape()
    {
        $field_name              = 'fieldname';
        $field_value             = '&';
        $fieldhandler_type_chain = 'Fullspecialchars';

        $results = $this->adapter->escape($field_name, $field_value, $fieldhandler_type_chain, array());

        if (PHP_VERSION_ID < 50400) {
            $this->assertEquals('&#38;', $results);
        } else {
            $this->assertEquals('&amp;', $results);
        }

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Fullspecialchars::validate
     * @expectedException CommonApi\Exception\UnexpectedValueException
     * @return  void
     * @since   1.0
     */
    public function testValidate()
    {
        $field_name              = 'fieldname';
        $field_value             = '&';
        $fieldhandler_type_chain = 'Fullspecialchars';

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, array());

        return;
    }

    /**
     * Tear down
     *
     * @return void
     * @since   1.0
     */
    protected function tearDown()
    {
    }
}
