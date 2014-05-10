<?php
/**
 * Null Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Null Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class NullTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Null::validate
     * @covers  Molajo\Fieldhandler\Constraint\Null::validation
     * @covers  Molajo\Fieldhandler\Constraint\Null::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Null::setValidateMessage
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
    public function testValidateTrue()
    {
        $field_name  = 'Random Field';
        $field_value = Null;
        $constraint  = 'Null';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Null::validate
     * @covers  Molajo\Fieldhandler\Constraint\Null::validation
     * @covers  Molajo\Fieldhandler\Constraint\Null::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Null::setValidateMessage
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
        $constraint  = 'Null';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(Null, $results->getValidateResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: Random Field does not have a valid value for Null data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Null::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Null::validation
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
        $field_value = Null;
        $constraint  = 'Null';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(Null, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Null::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Null::validation
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
        $field_value = true;
        $constraint  = 'Null';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Null::format
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
        $constraint  = 'Null';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals(0, $results->getFieldValue());
        $this->assertEquals(Null, $results->getChangeIndicator());

        return;
    }
}
