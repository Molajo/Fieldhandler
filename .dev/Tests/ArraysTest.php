<?php
/**
 * Arrays Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request as request;
use PHPUnit_Framework_TestCase;

/**
 * Arrays Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class ArraysTest extends PHPUnit_Framework_TestCase
{
    /**
     * Request
     *
     * @var    object  Molajo\Fieldhandler\Request
     * @since  1.0.0
     */
    protected $request;

    /**
     * Set up
     *
     * @return void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $this->request = new Request();
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validate
     * @return void
     * @since   1.0.0
     */
    public function testValid()
    {
        $input   = array();
        $input[] = 1;
        $input[] = 2;

        $field_name  = 'test';
        $field_value = $input;
        $constraint  = 'Arrays';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        $messages         = $results->getValidationMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validate
     * @return void
     * @since   1.0.0
     */
    public function testInvalidKeysValuesCount()
    {
        $input    = array();
        $input[1] = 1;
        $input[2] = 2;

        $field_name                    = 'test';
        $field_value                   = $input;
        $constraint                    = 'Arrays';
        $options                       = array();
        $options['array_valid_keys']   = array(1, 3, 4);
        $options['array_valid_values'] = array(1, 3, 4);
        $options['array_minimum']      = 0;
        $options['array_maximum']      = 1;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidationResponse());
        $messages = $results->getValidationMessages();
        $this->assertEquals(3, count($messages));

        return;
    }

    /**
     * test Validate Fail
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFailure()
    {
        $field_name  = 'alias';
        $field_value = 'dog';
        $constraint  = 'Arrays';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidationResponse());

        $messages         = $results->getValidationMessages();
        $expected_code    = 3000;
        $expected_message = 'Field: alias is not an array.';
        $messages         = $results->getValidationMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * test Filter Success
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterSuccess()
    {
        $input   = array();
        $input[] = 1;
        $input[] = 2;

        $field_name  = 'alias';
        $field_value = $input;
        $constraint  = 'Arrays';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        $messages         = $results->getValidationMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * test Filter Success 2
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterSuccess2()
    {
        $input   = array();
        $input[] = 'dog';

        $field_name  = 'alias';
        $field_value = $input;
        $constraint  = 'Arrays';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        $messages         = $results->getValidationMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * test Filter Success 3
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterSuccess3()
    {
        $input   = array();
        $input[] = 'dog';
        $input[] = 'cat';

        $field_name  = 'alias';
        $field_value = $input;
        $constraint  = 'Arrays';

        $array_valid_values   = array();
        $array_valid_values[] = 'dog';
        $array_valid_values[] = 'cat';
        $array_valid_values[] = 'dogs';
        $array_valid_values[] = 'cats';
        $options              = array('array_valid_values' => $array_valid_values);

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        return;
    }

    /**
     * test Filter Fail 1
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterFail1()
    {
        $input   = array();
        $input[] = 'dog';
        $input[] = 'cat';

        $field_name  = 'alias';
        $field_value = $input;
        $constraint  = 'Arrays';

        $array_valid_values   = array();
        $array_valid_values[] = 'x';
        $array_valid_values[] = 'y';

        $options = array('array_valid_values' => $array_valid_values);

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $messages         = $results->getValidationMessages();
        $expected_code    = 4000;
        $expected_message = 'Field: alias has an invalid array element value.';
        $messages         = $results->getValidationMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * test Escape Success
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testEscapeSuccess()
    {
        $input   = array();
        $input[] = 1;
        $input[] = 2;

        $field_name  = 'alias';
        $field_value = $input;
        $constraint  = 'Arrays';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        return;
    }

    /**
     * test Escape Fail
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testEscapeSuccess2()
    {
        $input   = array();
        $input[] = 'dog';

        $field_name  = 'alias';
        $field_value = $input;
        $constraint  = 'Arrays';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        return;
    }
}
