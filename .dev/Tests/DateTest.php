<?php
/**
 * Date Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request as request;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Date Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class DateTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Date::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccessDefault()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = '2013-04-01';
        $constraint  = 'Date';

        $results = $this->request->validate($field_name, $field_value, $constraint);

        $this->assertEquals(true, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = 'gggghhhhhh';
        $constraint = 'Date';

        $results = $this->request->validate($field_name, $field_value, $constraint);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 2000;
        $expected_message = 'Field: this_is_a_date_field must only contain Date values.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testHandleInputSuccessDefault()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = '2012-09-13';
        $constraint  = 'Date';
        $options     = array(
            'create_from_date_format' => 'Y-m-d',
            'display_as_date_format' => 'd/m/Y'
        );

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::validate
     * @return  void
     * @since   1.0.0
     */
    public function testHandleInputFailNull()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = 'gggghhhhhh';

        $constraint = 'Date';

        $results = $this->request->handleInput($field_name, $field_value, $constraint);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testHandleOutputSuccessDefault()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = '2012-09-13';
        $constraint  = 'Date';
        $options     = array(
            'create_from_date_format' => 'Y-m-d',
            'display_as_date_format' => 'm/d/Y'
        );

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $this->assertEquals('09/13/2012', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }
}
