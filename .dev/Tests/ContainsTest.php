<?php
/**
 * Contains Fieldhandler Test
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
 * Contains Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class ContainsTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Adapter\Contains::validate
     * @return  void
     * @since   1.0
     */
    public function testEscape()
    {
        $field_name              = 'fieldname';
        $field_value             = 'first dog last';
        $fieldhandler_type_chain = 'Contains';
        $options                 = array();
        $options['contains']     = 'dog';

        $results = $this->adapter->escape($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Adapter\Contains::validate
     * @expectedException CommonApi\Exception\UnexpectedValueException
     * @return  void
     * @since   1.0
     */
    public function testValidateFail()
    {
        $field_name              = 'fieldname';
        $field_value             = 'first cat last';
        $fieldhandler_type_chain = 'Contains';
        $options                 = array();
        $options['contains']     = 'dog';

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

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
