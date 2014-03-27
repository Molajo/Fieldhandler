<?php
/**
 * Values Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as adapter;
use PHPUnit_Framework_TestCase;

/**
 * Values Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class ValuesTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Adapter\upper::validate
     * @return void
     * @since   1.0
     */
    public function testValid()
    {
        $field_name                    = 'test';
        $field_value                   = 'a';
        $fieldhandler_type_chain       = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($results, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\upper::validate
     * @expectedException CommonApi\Exception\UnexpectedValueException
     * @return void
     * @since   1.0
     */
    public function testValidateFail()
    {
        $field_name                    = 'test';
        $field_value                   = 'z';
        $fieldhandler_type_chain       = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\upper::filter
     * @return void
     * @since   1.0
     */
    public function testFilterValid()
    {
        $field_name                    = 'test';
        $field_value                   = 'z';
        $fieldhandler_type_chain       = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(null, $results);

        return;
    }
}
