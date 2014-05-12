<?php
/**
 * Date Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
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
     * @covers  Molajo\Fieldhandler\Constraint\Date::validate
     * @covers  Molajo\Fieldhandler\Constraint\Date::format
     * @covers  Molajo\Fieldhandler\Constraint\Date::validation
     * @covers  Molajo\Fieldhandler\Constraint\Date::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccessTrue()
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
     * @covers  Molajo\Fieldhandler\Constraint\Date::format
     * @covers  Molajo\Fieldhandler\Constraint\Date::validation
     * @covers  Molajo\Fieldhandler\Constraint\Date::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = 'gggghhhhhh';
        $constraint  = 'Date';

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
     * @covers  Molajo\Fieldhandler\Constraint\Date::validate
     * @covers  Molajo\Fieldhandler\Constraint\Date::format
     * @covers  Molajo\Fieldhandler\Constraint\Date::validation
     * @covers  Molajo\Fieldhandler\Constraint\Date::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = '2012-09-13';
        $constraint  = 'Date';
        $options     = array(
            'create_from_format' => 'Y-m-d',
            'display_as_format'  => 'd/m/Y'
        );

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::validate
     * @covers  Molajo\Fieldhandler\Constraint\Date::format
     * @covers  Molajo\Fieldhandler\Constraint\Date::validation
     * @covers  Molajo\Fieldhandler\Constraint\Date::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = 'gggghhhhhh';

        $constraint = 'Date';

        $results = $this->request->sanitize($field_name, $field_value, $constraint);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::validate
     * @covers  Molajo\Fieldhandler\Constraint\Date::format
     * @covers  Molajo\Fieldhandler\Constraint\Date::validation
     * @covers  Molajo\Fieldhandler\Constraint\Date::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = '2012-09-13';
        $constraint  = 'Date';
        $options     = array(
            'create_from_format' => 'Y-m-d',
            'display_as_format'  => 'm/d/Y'
        );

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals('09/13/2012', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::format
     * @covers  Molajo\Fieldhandler\Constraint\Date::validation
     * @covers  Molajo\Fieldhandler\Constraint\Date::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormatNull()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = null;
        $constraint  = 'Date';

        $results = $this->request->format($field_name, $field_value, $constraint);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::format
     * @covers  Molajo\Fieldhandler\Constraint\Date::validation
     * @covers  Molajo\Fieldhandler\Constraint\Date::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractDatetime::createFromFormat
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormatBadDate()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = 'This is not a date';
        $constraint  = 'Date';

        $results = $this->request->format($field_name, $field_value, $constraint);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }
}
