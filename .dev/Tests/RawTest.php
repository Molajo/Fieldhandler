<?php
/**
 * Raw FieldHandler Test
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Tests;

use Molajo\FieldHandler\Adapter as adapter;
use PHPUnit_Framework_TestCase;

/**
 * Raw FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class RawTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\FieldHandler\Handler\Raws::validate
     * @return  void
     * @since   1.0
     */
    public function testValidate1()
    {
        $field_name              = 'field1';
        $field_value             = '<h2>Raw</h2>';
        $fieldhandler_type_chain = 'Raw';

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain);

        $this->assertEquals($field_value, $results);

        return;
    }
    /**
     * @covers  Molajo\FieldHandler\Handler\Raws::escape
     * @return void
     * @since   1.0
     */
    public function testEscapeFail()
    {
        $field_name              = 'field1';
        $field_value             = '&';
        $fieldhandler_type_chain = 'Raw';
        $options                 = array();
        $options['FILTER_FLAG_ENCODE_AMP']       = true;

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }
}
