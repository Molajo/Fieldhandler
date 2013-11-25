<?php
/**
 * Defaults Fieldhandler Test
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
 * Defaults Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class DefaultsTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Handler\Defaults::validate
     * @return  void
     * @since   1.0
     */
    public function testValid()
    {
        $field_name              = 'dog';
        $field_value             = null;
        $fieldhandler_type_chain = 'Defaults';
        $options                 = array(
            'default' => 'bark'
        );

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = 'bark';
        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Handler\Defaults::validate
     * @return void
     * @since   1.0
     */
    public function testValidateFail()
    {
        $field_name              = 'dog';
        $field_value             = null;
        $fieldhandler_type_chain = 'Defaults';
        $options                 = array(
            'default' => 'bark'
        );

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $field_value = 'bark';
        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Handler\Defaults::validate
     * @return  void
     * @since   1.0
     */
    public function testValidCat()
    {
        $field_name              = 'cat';
        $field_value             = 'meow';
        $fieldhandler_type_chain = 'Defaults';
        $options                 = array(
            'default' => 'bark'
        );

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

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
