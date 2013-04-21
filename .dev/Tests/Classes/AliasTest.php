<?php
/**
 * Alias FieldHandler Test
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
 * Alias FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class AliasTest extends PHPUnit_Framework_TestCase
{
    /**
     * Set up
     *
     * @return void
     * @since   1.0
     */
    protected function setUp()
    {
        parent::setUp();

        return;
    }

    /**
     * @covers Molajo\FieldHandler\Handler\Alias::validate
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @return void
     * @since   1.0
     */
    public function testValidateFail()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'alias';
        $field_value             = 'Jack and Jill';
        $fieldhandler_type_chain = 'Alias';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals(1, $adapter->field_value);

        return;
    }

    /**
     * @covers Molajo\FieldHandler\Handler\Alias::filter
     * @return void
     * @since   1.0
     */
    public function testFilterSucceed()
    {
        parent::setUp();

        $method                  = 'Filter';
        $field_name              = 'alias';
        $field_value             = 'Jack and Jill';
        $fieldhandler_type_chain = 'Alias';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('jack-and-jill', $adapter->field_value);

        return;
    }

    /**
     * @covers Molajo\FieldHandler\Handler\Alias::escape
     * @return void
     * @since   1.0
     */
    public function testEscapeSucceed()
    {
        parent::setUp();

        $method                  = 'Escape';
        $field_name              = 'alias';
        $field_value             = 'Jack *&and+Jill';
        $fieldhandler_type_chain = 'Alias';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('jack-and-jill', $adapter->field_value);

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
