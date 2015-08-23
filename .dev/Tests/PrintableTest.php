<?php
/**
 * Printable Constraint Test
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Printable Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class PrintableTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Printable::validate
     * @covers  Molajo\Fieldhandler\Constraint\Printable::validation
     * @covers  Molajo\Fieldhandler\Constraint\Printable::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Printable::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::sanitizeByCType
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeByCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrue()
    {
        $field_name  = 'test';
        $field_value = "Dogfood";
        $constraint  = 'Printable';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Printable::validate
     * @covers  Molajo\Fieldhandler\Constraint\Printable::validation
     * @covers  Molajo\Fieldhandler\Constraint\Printable::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Printable::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::sanitizeByCType
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeByCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name  = 'test';
        $field_value = "xyz\n\r\t";
        $constraint  = 'Printable';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 2000;
        $expected_message = 'Field: test must only contain Printable values.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Printable::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Printable::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::sanitizeByCType
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeByCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name  = 'test';
        $field_value = "Dogfood";
        $constraint  = 'Printable';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Printable::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Printable::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::sanitizeByCType
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeByCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name  = 'test';
        $field_value = "Dogfood\n\r\t";
        $constraint  = 'Printable';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $expected_value = "Dogfood";
        $this->assertEquals($expected_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Printable::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name  = 'test';
        $field_value = '1A2b3C4d5E6f7G8';
        $constraint  = 'Printable';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
