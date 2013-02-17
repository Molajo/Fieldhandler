<?php
/**
 * Alpha FieldHandler Test
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Tests;

defined('MOLAJO') or die;

use Molajo\FieldHandler\Adapter as adapter;
use PHPUnit_Framework_TestCase;

/**
 * Alpha FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class AlphaTest extends PHPUnit_Framework_TestCase
{
    /**
     * Set up
     *
     * @return  void
     * @since   1.0
     */
    protected function setUp()
    {
        parent::setUp();

        return;
    }

    /**
     * test Validate Success
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testValidateSuccess()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'alias';
        $field_value             = 'AbCdEfG';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('AbCdEfG', $adapter->field_value);

        return;
    }

    /**
     * test Validate Fail
     *
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testValidateSuccess2()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'alias';
        $field_value             = 123;
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('yes', $adapter->field_value);

        return;
    }

    /**
     * test Filter Success
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testFilterSuccess1()
    {
        parent::setUp();

        $method                  = 'Filter';
        $field_name              = 'alias';
        $field_value             = 'AbCdEfG';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('AbCdEfG', $adapter->field_value);

        return;
    }


    /**
     * test Filter Success2
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testFilterSuccess2()
    {
        parent::setUp();

        $method                  = 'Filter';
        $field_name              = 'alias';
        $field_value             = 'Ab2CdE3fG';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('AbCdEfG', $adapter->field_value);

        return;
    }

    /**
     * test Filter Success
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testEscapeSuccess1()
    {
        parent::setUp();

        $method                  = 'Escape';
        $field_name              = 'alias';
        $field_value             = 'AbCdEfG';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('AbCdEfG', $adapter->field_value);

        return;
    }


    /**
     * test Filter Success2
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testEscapeSuccess2()
    {
        parent::setUp();

        $method                  = 'Escape';
        $field_name              = 'alias';
        $field_value             = 'Ab2CdE3fG';
        $fieldhandler_type_chain = 'Alpha';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('AbCdEfG', $adapter->field_value);

        return;
    }

    /**
     * Tear down
     *
     * @return  void
     * @since   1.0
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
