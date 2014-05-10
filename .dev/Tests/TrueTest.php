<?php
/**
 * True Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * True Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class TrueTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\True::validate
     * @covers  Molajo\Fieldhandler\Constraint\True::validation
     * @covers  Molajo\Fieldhandler\Constraint\True::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\True::setValidateMessage
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
    public function testValidateTrueYes()
    {
        $field_name  = 'agreement';
        $field_value = 'yes';
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\True::validate
     * @covers  Molajo\Fieldhandler\Constraint\True::validation
     * @covers  Molajo\Fieldhandler\Constraint\True::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\True::setValidateMessage
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
    public function testValidateTrue1()
    {
        $field_name  = 'agreement';
        $field_value = 1;
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\True::validate
     * @covers  Molajo\Fieldhandler\Constraint\True::validation
     * @covers  Molajo\Fieldhandler\Constraint\True::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\True::setValidateMessage
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
    public function testValidateTrueTrue()
    {
        $field_name  = 'agreement';
        $field_value = true;
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\True::validate
     * @covers  Molajo\Fieldhandler\Constraint\True::validation
     * @covers  Molajo\Fieldhandler\Constraint\True::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\True::setValidateMessage
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
    public function testValidateTrueOn()
    {
        $field_name  = 'agreement';
        $field_value = 'on';
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\True::validate
     * @covers  Molajo\Fieldhandler\Constraint\True::validation
     * @covers  Molajo\Fieldhandler\Constraint\True::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\True::setValidateMessage
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
        $field_name  = 'Agreement';
        $field_value = 122222;
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: Agreement does not have a valid value for True data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\True::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\True::validation
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
        $field_name  = 'single';
        $field_value = true;
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\True::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\True::validation
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
        $field_name  = 'single';
        $field_value = false;
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\True::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name  = 'single';
        $field_value = 0;
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals(0, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
