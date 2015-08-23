<?php
/**
 * String Constraint Test
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * String Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class StringTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\String::validate
     * @covers  Molajo\Fieldhandler\Constraint\String::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\String::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::validateCompare
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitizeValidate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlags
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlag
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidate()
    {
        // validate always returns false since it is not implemented for this constraint

        $field_name                            = 'fieldname';
        $field_value                           = null;
        $constraint                            = 'String';
        $options                               = array();
        $options[FILTER_FLAG_NO_ENCODE_QUOTES] = true;
        $options[FILTER_FLAG_STRIP_LOW]        = true;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\String::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::validateCompare
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitizeValidate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name  = 'fieldname';
        $field_value = '<div>The dog is fine.</div>';
        $constraint  = 'String';

        $results = $this->request->sanitize($field_name, $field_value, $constraint);

        $this->assertEquals('The dog is fine.', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\String::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::validateCompare
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitizeValidate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlags
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlag
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChangeQuotes()
    {
        $field_name                            = 'fieldname';
        $field_value                           = '"The dog is fine."';
        $constraint                            = 'String';
        $options                               = array();
        $options[FILTER_FLAG_NO_ENCODE_QUOTES] = true;
        $options[FILTER_FLAG_STRIP_LOW]        = true;

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\String::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::validateCompare
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitizeValidate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name                            = 'fieldname';
        $field_value                           = 'The dog is fine.';
        $constraint                            = 'String';
        $options                               = array();
        $options[FILTER_FLAG_NO_ENCODE_QUOTES] = true;
        $options[FILTER_FLAG_STRIP_LOW]        = true;

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\String::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name                            = 'fieldname';
        $field_value                           = '<div>The dog is fine.</div>';
        $constraint                            = 'String';
        $options                               = array();
        $options[FILTER_FLAG_NO_ENCODE_QUOTES] = true;
        $options[FILTER_FLAG_STRIP_LOW]        = true;

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
