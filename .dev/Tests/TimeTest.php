<?php
/**
 * Time Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Time Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class TimeTest extends PHPUnit_Framework_TestCase
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
     * @return  void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $this->request = new Request();
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Time::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getvalidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setvalidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccessTrue()
    {
        $field_name  = 'this_is_a_Time_field';
        $field_value = '12:30:00';
        $constraint  = 'Time';
        $options     = array(
            'create_from_time_format' => 'H:i:s',
            'display_as_time_format'  => 'H:i:s'
        );

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getvalidateResponse());

        $messages = $results->getvalidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Time::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getvalidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setvalidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name  = 'this_is_a_Time_field';
        $field_value = 'gggghhhhhh';
        $constraint  = 'Time';
        $options     = array(
            'create_from_time_format' => 'H:i:s',
            'display_as_time_format'  => 'H:i:s'
        );

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getvalidateResponse());

        $expected_code    = 2000;
        $expected_message = 'Field: this_is_a_Time_field must only contain Time values.';
        $messages         = $results->getvalidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Time::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getvalidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setvalidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name  = 'this_is_a_Time_field';
        $field_value = '12:30:00';
        $constraint  = 'Time';
        $options     = array(
            'create_from_time_format' => 'H:i:s',
            'display_as_time_format'  => 'H:i:s'
        );

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Time::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Time::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getvalidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setvalidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name  = 'this_is_a_Time_field';
        $field_value = 'gggghhhhhh';
        $constraint = 'Time';
        $options     = array(
            'create_from_time_format' => 'H:i:s',
            'display_as_time_format'  => 'H:i:s'
        );

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Time::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormatSuccess()
    {
        $field_name  = 'this_is_a_Time_field';
        $field_value = '12:30:00';
        $constraint  = 'Time';
        $options     = array(
            'create_from_time_format' => 'H:i:s',
            'display_as_time_format'  => 'H:i'
        );

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals('12:30', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }
}
