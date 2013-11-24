<?php
/**
 * Equal Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Adapter as adapter;
use PHPUnit_Framework_TestCase;
use Exception\Model\FieldhandlerException;

/**
 * Object Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class ObjectTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Handler\Objects::validate
     * @return  void
     * @since   1.0
     */
    public function testValidate1()
    {
        $field_name              = 'field1';
        $field_value             = new \stdClass();
        $fieldhandler_type_chain = 'Object';
        $options                 = array();

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Handler\Objects::validate
     * @expectedException Exception\Model\FieldhandlerException
     * @return void
     * @since   1.0
     */
    public function testValidateFail()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Object';
        $options                 = array();

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        return;
    }
}
