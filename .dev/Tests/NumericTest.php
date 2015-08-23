<?php
/**
 * Numeric Constraint Test
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Numeric Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class NumericTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::validate
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::validation
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrue()
    {
        $field_name  = 'numeric_fieldname';
        $field_value = 1234;
        $constraint  = 'Numeric';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::validate
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::validation
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrueNull()
    {
        $field_name  = 'numeric_fieldname';
        $field_value = null;
        $constraint  = 'Numeric';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::validate
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::validation
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name  = 'numeric_fieldname';
        $field_value = 'yessireebob';
        $constraint  = 'Numeric';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: numeric_fieldname does not have a valid value for Numeric data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name  = 'numeric_fieldname';
        $field_value = 123;
        $constraint  = 'Numeric';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name  = 'numeric_fieldname';
        $field_value = '333dog';
        $constraint  = 'Numeric';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Numeric::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name  = 'numeric_fieldname';
        $field_value = 123;
        $constraint  = 'Numeric';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
