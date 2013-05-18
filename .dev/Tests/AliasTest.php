<?php
/**
 * Alias FieldHandler Test
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Tests;

use Molajo\FieldHandler\Adapter as adapter;
use PHPUnit_Framework_TestCase;
use Molajo\FieldHandler\Exception\FieldHandlerException;

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
     * @covers  Molajo\FieldHandler\Handler\Alias::validate
     * @return  void
     * @since   1.0
     */
    public function testValid()
    {
        $field_name              = 'alias';
        $field_value             = 'jack-and-jill';
        $fieldhandler_type_chain = 'Alias';
        $options                 = array();

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Alias::validate
     * @expectedException PHPUnit_Framework_ExpectationFailedException
     * @return void
     * @since   1.0
     */
    public function testValidateFail()
    {
        $field_name              = 'alias';
        $field_value             = 'Jack and Jill';
        $fieldhandler_type_chain = 'Alias';
        $options                 = array();

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Alias::filter
     * @return void
     * @since   1.0
     */
    public function testFilterSucceed2()
    {
        $field_name              = 'alias';
        $field_value             = 'Jack and Jill';
        $fieldhandler_type_chain = 'Alias';
        $options                 = array();

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('jack-and-jill', $results);

        return;
    }

    /**
     * @covers  Molajo\FieldHandler\Handler\Alias::escape
     * @return void
     * @since   1.0
     */
    public function testEscapeSucceed3()
    {
        $field_name              = 'alias';
        $field_value             = 'Jack *&and+Jill';
        $fieldhandler_type_chain = 'Alias';
        $options                 = array();

        $results = $this->adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('jack-and-jill', $results);

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
