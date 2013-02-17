<?php
/**
 * Array FieldHandler Test
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
 * Array FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class ArraysTest extends PHPUnit_Framework_TestCase
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
     * test Validate Success
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testValidateSuccess()
    {
        parent::setUp();

        $input = array();
        $input[] = 1;
        $input[] = 2;

        $method                  = 'Validate';
        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Arrays';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($input, $adapter->field_value);

        return;
    }

    /**
     * test Validate Fail
     *
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testValidateSuccess2()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'alias';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Arrays';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        return;
    }

    /**
     * test Filter Success
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testFilterSuccess()
    {
        parent::setUp();

        $input = array();
        $input[] = 1;
        $input[] = 2;

        $method                  = 'Filter';
        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Arrays';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($input, $adapter->field_value);

        return;
    }

    /**
     * test Filter Success 2
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testFilterSuccess2()
    {
        parent::setUp();

        $input = array();
        $input[] = 'dog';

        $method                  = 'Filter';
        $field_name              = 'alias';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Arrays';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($input, $adapter->field_value);

        return;
    }

    /**
     * test Filter Success 3
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testFilterSuccess3()
    {
        parent::setUp();

        $input = array();
        $input[] = 'dog';
        $input[] = 'cat';

        $method                  = 'Filter';
        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Arrays';

        $array_valid_values = array();
        $array_valid_values[] = 'dog';
        $array_valid_values[] = 'cat';
        $array_valid_values[] = 'dogs';
        $array_valid_values[] = 'cats';
        $options = array('array_valid_values' => $array_valid_values);

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($input, $adapter->field_value);

        return;
    }

    /**
     * test Filter Fail 1
     *
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testFilterFail1()
    {
        parent::setUp();

        $input = array();
        $input[] = 'dog';
        $input[] = 'cat';

        $method                  = 'Filter';
        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Arrays';

        $array_valid_values = array();
        $array_valid_values[] = 'x';
        $array_valid_values[] = 'y';

        $options = array('array_valid_values' => $array_valid_values);

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);
        var_dump($adapter);
        $this->assertEquals($input, $adapter->field_value);

        return;
    }

    /**
     * test Escape Success
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testEscapeSuccess()
    {
        parent::setUp();

        $input = array();
        $input[] = 1;
        $input[] = 2;

        $method                  = 'Escape';
        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Arrays';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($input, $adapter->field_value);

        return;
    }

    /**
     * test Escape Fail
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return void
     * @since   1.0
     */
    public function testEscapeSuccess2()
    {
        parent::setUp();

        $input = array();
        $input[] = 'dog';

        $method                  = 'Escape';
        $field_name              = 'alias';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Arrays';
        $options                 = array();

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($input, $adapter->field_value);

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
