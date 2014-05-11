<?php
/**
 * Scalar Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Scalar Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class ScalarTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::validate
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::validation
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validation
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
        $field_name  = 'random_field';
        $field_value = 'AbC dEfG';
        $constraint  = 'Scalar';

        $results = $this->request->validate($field_name, $field_value, $constraint);

        $this->assertEquals(true, $results->getValidateResponse());
        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::validate
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::validation
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validation
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
        $field_name  = 'random_field';
        $field_value = array(1, 2, 3);
        $constraint  = 'Scalar';

        $results = $this->request->validate($field_name, $field_value, $constraint);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: random_field does not have a valid value for Scalar data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeByCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitizeNull
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNull()
    {
        $field_name  = 'random_field';
        $field_value = null;
        $constraint  = 'Scalar';

        $results = $this->request->sanitize($field_name, $field_value, $constraint);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeByCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitizeNull
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name  = 'random_field';
        $field_value = true;
        $constraint  = 'Scalar';

        $results = $this->request->sanitize($field_name, $field_value, $constraint);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeByCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitizeNull
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name  = 'test';
        $field_value = new \stdClass();
        $constraint  = 'Scalar';

        $results = $this->request->sanitize($field_name, $field_value, $constraint);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Scalar::format
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
        $constraint  = 'Scalar';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
