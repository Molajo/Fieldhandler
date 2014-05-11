<?php
/**
 * Nothing Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Nothing Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class NothingTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::validate
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::validation
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return void
     * @since   1.0.0
     */
    public function testValidateTrueFalse()
    {
        $field_name  = 'Random Field';
        $field_value = false;
        $constraint  = 'Nothing';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::validate
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::validation
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrue0()
    {
        $field_name  = 'Random Field';
        $field_value = 0;
        $constraint  = 'Nothing';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::validate
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::validation
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrueSpace()
    {
        $field_name  = 'Random Field';
        $field_value = ' ';
        $constraint  = 'Nothing';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::validate
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::validation
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return void
     * @since   1.0.0
     */
    public function testValidateTrueNull()
    {
        $field_name  = 'Random Field';
        $field_value = null;
        $constraint  = 'Nothing';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::validate
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::validation
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name  = 'Random Field';
        $field_value = 122222;
        $constraint  = 'Nothing';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: Random Field does not have a valid value for Nothing data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name  = 'Random Field';
        $field_value = 0;
        $constraint  = 'Nothing';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name  = 'Random Field';
        $field_value = true;
        $constraint  = 'Nothing';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Nothing::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name  = 'Random Field';
        $field_value = 44;
        $constraint  = 'Nothing';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
