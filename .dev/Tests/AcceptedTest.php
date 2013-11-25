<?php
/**
 * Accepted Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Adapter as adapter;
use PHPUnit_Framework_TestCase;

/**
 * Accepted Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class AcceptedTest extends PHPUnit_Framework_TestCase
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
     * test Validate Success
     *
     * @covers  Molajo\Fieldhandler\Handler\Default::validate
     * @return void
     * @since   1.0
     */
    public function testValidateSuccess1()
    {
        $field_name              = 'agreement';
        $field_value             = 1;
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $field_value = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(1, $field_value);

        return;
    }

    /**
     * test Validate Success2
     *
     * @covers  Molajo\Fieldhandler\Handler\Default::validate
     * @return void
     * @since   1.0
     */
    public function testValidateSuccess2()
    {
        $field_name              = 'agreement';
        $field_value             = 'yes';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $field_value = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('yes', $field_value);

        return;
    }

    /**
     * test Validate Success 3
     *
     * @covers  Molajo\Fieldhandler\Handler\Default::validate
     * @return void
     * @since   1.0
     */
    public function testValidateSuccess3()
    {
        $field_name              = 'agreement';
        $field_value             = 'on';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $field_value = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('on', $field_value);

        return;
    }

    /**
     * test Validate Success 4
     *
     * @covers  Molajo\Fieldhandler\Handler\Default::validate
     * @return void
     * @since   1.0
     */
    public function testValidateSuccess4()
    {
        $field_name              = 'agreement';
        $field_value             = true;
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $field_value = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(true, $field_value);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Handler\Default::validate
     * @expectedException CommonApi\Exception\UnexpectedValueException
     * @return void
     * @since   1.0
     */
    public function testValidateUnsuccessful()
    {
        $field_name              = 'agreement';
        $field_value             = 'nope';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $field_value = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        return;
    }

    /**
     * test Filter Success
     *
     * @covers  Molajo\Fieldhandler\Handler\Default::validate
     * @return void
     * @since   1.0
     */
    public function testFilterSuccess()
    {
        $field_name              = 'agreement';
        $field_value             = 'on';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $field_value = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('on', $field_value);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Handler\Default::filter
     * @return void
     * @since   1.0
     */
    public function testFilterUnsuccessful()
    {
        $field_name              = 'agreement';
        $field_value             = 'noway';
        $fieldhandler_type_chain = 'Accepted';
        $options                 = array();

        $field_value = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

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
        parent::tearDown();
    }
}
