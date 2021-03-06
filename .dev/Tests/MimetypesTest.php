<?php
/**
 * Mimetypes Constraint Test
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Mimetypes Test
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class MimetypesTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::validate
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::validation
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::createFieldValueArrayComparison
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
        $field_name  = 'File Extension';
        $field_value = 'image/jpeg';
        $constraint  = 'Mimetypes';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::validate
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::validation
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::createFieldValueArrayComparison
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
        $field_name  = 'File Extension';
        $field_value = 122222;
        $constraint  = 'Mimetypes';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: File Extension does not have a valid value for Mimetypes data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::createFieldValueArrayComparison
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
        $field_name  = 'Mime type';
        $field_value = 'image/jpeg';
        $constraint  = 'Mimetypes';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::__construct
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::getCompareToArrayFromOptions
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::testArrayInputAgainstValidArray
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::createFieldValueArrayComparison
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
        $field_name  = 'Mime type';
        $field_value = 'application/doc';
        $constraint  = 'Mimetypes';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Mimetypes::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractArrays::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name  = 'Mime type';
        $field_value = 0;
        $constraint  = 'Mimetypes';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals(0, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
