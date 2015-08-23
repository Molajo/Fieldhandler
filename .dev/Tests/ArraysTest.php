<?php
/**
 * Arrays Constraint Test
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Arrays Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
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
     * @covers                   Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers                   Molajo\Fieldhandler\Request::getValidateMessages
     * @covers                   Molajo\Fieldhandler\Constraint\Arrays::validate
     * @expectedException        \CommonApi\Exception\UnexpectedValueException
     * @expectedExceptionRequest Fieldhandler Arrays getCompareToArrayFromInput: invalid empty array
     *
     * @since                    1.0.0
     */
    public function testNoValidValuesArray()
    {
        $field_name  = null;
        $field_value = array(123);
        $constraint  = 'Array';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validate
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::runValidationTest
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testIsArray
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testValues
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validation
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::createFieldValueArrayComparison
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testCount
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
        $field_name                    = 'test';
        $field_value                   = array(1, 2);
        $constraint                    = 'Arrays';
        $options                       = array('valid_values_array' => array(1, 2, 3));
        $options['valid_values_array'] = array(1, 2, 3);
        $options['array_minimum']      = 1;
        $options['array_maximum']      = 10;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validate
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::runValidationTest
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testIsArray
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testValues
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validation
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::createFieldValueArrayComparison
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testCount
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
    public function testValidateNotAnArray()
    {
        $field_name  = 'alias';
        $field_value = 'dog';
        $constraint  = 'Arrays';
        $options     = array('valid_values_array' => array());

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 3000;
        $expected_message = 'Field: alias is not an array.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validate
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::runValidationTest
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testIsArray
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testValues
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validation
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::createFieldValueArrayComparison
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testCount
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
    public function testValidateEmptyValidArray()
    {
        $field_name  = 'alias';
        $field_value = array('dog');
        $constraint  = 'Arrays';
        $options     = array('valid_values_array' => array());

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validate
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::runValidationTest
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testIsArray
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testValues
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validation
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::createFieldValueArrayComparison
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testCount
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
    public function testValidateLessThanMinimum()
    {
        $field_name                    = 'test';
        $field_value                   = array(1, 2);
        $constraint                    = 'Arrays';
        $options                       = array('valid_values_array' => array(1, 2, 3));
        $options['valid_values_array'] = array(1, 2, 3);
        $options['array_minimum']      = 10;
        $options['array_maximum']      = 100;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());
        $message = $results->getValidateMessages();
        $this->assertEquals(6000, $message[0]->code);
        $this->assertEquals('Field: test does not have the correct number of array values.', $message[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validate
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::runValidationTest
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testIsArray
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testValues
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validation
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::createFieldValueArrayComparison
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testCount
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
    public function testValidateMoreThanMaximum()
    {
        $field_name                    = 'test';
        $field_value                   = array(1, 2, 3);
        $constraint                    = 'Arrays';
        $options                       = array('valid_values_array' => array(1, 2, 3));
        $options['valid_values_array'] = array(1, 2, 3);
        $options['array_minimum']      = 1;
        $options['array_maximum']      = 2;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());
        $message = $results->getValidateMessages();
        $this->assertEquals(6000, $message[0]->code);
        $this->assertEquals('Field: test does not have the correct number of array values.', $message[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validate
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::runValidationTest
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testIsArray
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testValues
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::createFieldValueArrayComparison
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testCount
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitizeNull
     *
     * @return void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name  = 'animals';
        $field_value = array('dog', 'cat');
        $constraint  = 'Arrays';
        $options     = array('valid_values_array' => array('dog', 'cat', 'dogs', 'cats'));

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validate
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::runValidationTest
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testIsArray
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::testValues
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::createFieldValueArrayComparison
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testCount
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromInput
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testStringInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitizeNull
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name  = 'Random Array';
        $field_value = array('dog', 'cat');
        $constraint  = 'Arrays';
        $options     = array('valid_values_array' => array('x', 'y'));

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(array(), $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * test Escape Success
     *
     * @covers  Molajo\Fieldhandler\Constraint\Arrays::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     * @return void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name  = 'alias';
        $field_value = array(1, 2);
        $constraint  = 'Arrays';
        $options     = array('valid_values_array' => array('x', 'y'));

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
