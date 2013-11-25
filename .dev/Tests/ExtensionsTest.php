<?php
/**
 * Extensions Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Adapter as adapter;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Extensions Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class ExtensionsTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Handler\Extensions::validate
     * @return  void
     * @since   1.0
     */
    public function testValidate1()
    {
        $input   = array();
        $input[] = '.jpg';
        $input[] = '.gif';
        $input[] = '.png';

        $field_name              = 'extensions_field';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Extensions';
        $options                 = array();

        $array_valid_values   = array();
        $array_valid_values[] = '.jpg';
        $array_valid_values[] = '.gif';
        $array_valid_values[] = '.png';

        $options = array('array_valid_extensions' => $array_valid_values);

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Handler\Extensions::validate
     * @expectedException CommonApi\Exception\UnexpectedValueException
     * @return  void
     * @since   1.0
     */
    public function testValidateFail()
    {

        $field_name              = 'extensions_field';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Extensions';
        $options                 = array();

        $array_valid_values   = array();
        $array_valid_values[] = '.jpg';
        $array_valid_values[] = '.gif';
        $array_valid_values[] = '.png';

        $options = array('array_valid_extensions' => $array_valid_values);

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Handler\Extensions::validate
     * @return  void
     * @since   1.0
     */
    public function testFilter1()
    {
        $input   = array();
        $input[] = '.jpg';
        $input[] = '.gif';
        $input[] = '.png';

        $field_name              = 'extensions_field';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Extensions';
        $options                 = array();

        $array_valid_values   = array();
        $array_valid_values[] = '.jpg';
        $array_valid_values[] = '.gif';
        $array_valid_values[] = '.png';

        $options = array('array_valid_extensions' => $array_valid_values);

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Handler\Extensions::validate
     * @return  void
     * @since   1.0
     */
    public function testFilterFail()
    {

        $field_name              = 'extensions_field';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Extensions';
        $options                 = array();

        $array_valid_values   = array();
        $array_valid_values[] = '.jpg';
        $array_valid_values[] = '.gif';
        $array_valid_values[] = '.png';

        $options = array('array_valid_extensions' => $array_valid_values);

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(null, $results);

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
