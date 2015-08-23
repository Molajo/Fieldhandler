<?php
/**
 * Notvalues Constraint Test
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Notvalues Test
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class NotvaluesTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::validate
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::validation
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testStringInputAgainstValidArray
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
        $field_name                    = 'Random Fieldname';
        $field_value                   = 'z';
        $constraint                    = 'Notvalues';
        $options                       = array();
        $options['valid_values_array'] = array('a', 'b', 'c');

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::validate
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::validation
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testStringInputAgainstValidArray
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
        $field_name                    = 'Random Fieldname';
        $field_value                   = 'a';
        $constraint                    = 'Notvalues';
        $options                       = array();
        $options['valid_values_array'] = array('a', 'b', 'c');

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: Random Fieldname does not have a valid value for Notvalues data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testStringInputAgainstValidArray
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
        $field_name                    = 'Random Fieldname';
        $field_value                   = 'z';
        $constraint                    = 'Notvalues';
        $options                       = array();
        $options['valid_values_array'] = array('a', 'b', 'c');

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testStringInputAgainstValidArray
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
        $field_name                    = 'Random Fieldname';
        $field_value                   = 'a';
        $constraint                    = 'Notvalues';
        $options                       = array();
        $options['valid_values_array'] = array('a', 'b', 'c');

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name                    = 'Random Fieldname';
        $field_value                   = 'z';
        $constraint                    = 'Notvalues';
        $options                       = array();
        $options['valid_values_array'] = array('a', 'b', 'c');

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::validate
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::validation
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validateResponseArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validateResponseArrayTrue
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validateResponseArrayFalse
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
    public function testValidateTrueArray()
    {
        $field_name                    = 'Random Fieldname';
        $field_value                   = array('x', 'y');
        $constraint                    = 'Notvalues';
        $options                       = array();
        $options['valid_values_array'] = array('a', 'b', 'c');

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::validate
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::validation
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validateResponseArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validateResponseArrayTrue
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validateResponseArrayFalse
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
    public function testValidateFalseArray()
    {
        $field_name                    = 'Random Fieldname';
        $field_value                   = array('a', 'z');
        $constraint                    = 'Notvalues';
        $options                       = array();
        $options['valid_values_array'] = array('a', 'b', 'c');

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: Random Fieldname does not have a valid value for Notvalues data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validateResponseArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validateResponseArrayTrue
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validateResponseArrayFalse
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChangeArray()
    {
        $field_name                    = 'Random Fieldname';
        $field_value                   = array('x', 'y', 'z');
        $constraint                    = 'Notvalues';
        $options                       = array();
        $options['valid_values_array'] = array('a', 'b', 'c');

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validateResponseArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validateResponseArrayTrue
     * @covers  Molajo\Fieldhandler\Constraint\AbstractOpposite::validateResponseArrayFalse
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChangeArray()
    {
        $field_name                    = 'Random Fieldname';
        $field_value                   = array('a', 'z');
        $constraint                    = 'Notvalues';
        $options                       = array();
        $options['valid_values_array'] = array('a', 'b', 'c');

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(array('z'), $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notvalues::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormatArray()
    {
        $field_name                    = 'Random Fieldname';
        $field_value                   = array('a', 'z');
        $constraint                    = 'Notvalues';
        $options                       = array();
        $options['valid_values_array'] = array('a', 'b', 'c');

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
