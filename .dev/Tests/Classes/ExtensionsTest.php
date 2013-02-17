<?php
/**
 * Extensions FieldHandler Test
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
 * Extensions FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class ExtensionsTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\FieldHandler\Type\Extensions::validate
     * @return void
     * @since   1.0
     */
    public function testValidateSuccess()
    {
        parent::setUp();

        $input = array();
        $input[] = '.jpg';
        $input[] = '.gif';
        $input[] = '.png';

        $method                  = 'Validate';
        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Extensions';
        $options                 = array();

        $array_valid_values = array();
        $array_valid_values[] = '.jpg';
        $array_valid_values[] = '.gif';
        $array_valid_values[] = '.png';

        $options = array('array_valid_extensions' => $array_valid_values);

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($input, $adapter->field_value);

        return;
    }

    /**
     * test Validate Fail
     *
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @covers  Molajo\FieldHandler\Type\Extensions::validate
     * @return void
     * @since   1.0
     */
    public function testValidateSuccess2()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'alias';
        $field_value             = 'dog';
        $fieldhandler_type_chain = 'Extensions';
        $options                 = array();

        $array_valid_values = array();
        $array_valid_values[] = '.jpg';
        $array_valid_values[] = '.gif';
        $array_valid_values[] = '.png';

        $options = array('array_valid_extensions' => $array_valid_values);

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        return;
    }

    /**
     * Test Validate Fail
     *
     * @expectedException Molajo\FieldHandler\Exception\FieldHandlerException
     * @covers  Molajo\FieldHandler\Type\Extensions::validate
     * @return void
     * @since   1.0
     */
    public function testValidateFail()
    {
        parent::setUp();

        $input = array();
        $input[] = '.jpcccg';
        $input[] = '.gif';
        $input[] = '.png';

        $method                  = 'Validate';
        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Extensions';
        $options                 = array();

        $array_valid_values = array();
        $array_valid_values[] = '.jpg';
        $array_valid_values[] = '.gif';
        $array_valid_values[] = '.png';

        $options = array('array_valid_extensions' => $array_valid_values);

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($input, $adapter->field_value);

        return;
    }

    /**
     * Test Filter Succeed
     *
     * @covers  Molajo\FieldHandler\Type\Extensions::validate
     * @return void
     * @since   1.0
     */
    public function testFilterSucceed()
    {
        parent::setUp();

        $input = array();
        $input[] = '.jpcccg';
        $input[] = '.gif';
        $input[] = '.png';

        $method                  = 'Filter';
        $field_name              = 'alias';
        $field_value             = $input;
        $fieldhandler_type_chain = 'Extensions';
        $options                 = array();

        $array_valid_values = array();
        $array_valid_values[] = '.jpg';
        $array_valid_values[] = '.gif';
        $array_valid_values[] = '.png';

        $options = array('array_valid_extensions' => $array_valid_values);

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $input = array();
        $input[] = '.gif';
        $input[] = '.png';

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
