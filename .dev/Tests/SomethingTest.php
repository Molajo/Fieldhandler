<?php
/**
 * Something Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Something Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class SomethingTest extends PHPUnit_Framework_TestCase
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
     * Validate Success: Invalid Field Value
     *
     * @covers  Molajo\Fieldhandler\Constraint\Something::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccessNull()
    {
        $field_name  = 'agreement';
        $field_value = null;
        $constraint  = 'Something';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $expected_code    = 1000;
        $expected_message = 'Field: agreement does not have a valid value for Something data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * Validate Success: Invalid Field Value
     *
     * @covers  Molajo\Fieldhandler\Constraint\Something::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccessSpace()
    {
        $field_name  = 'agreement';
        $field_value = ' ';
        $constraint  = 'Something';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $expected_code    = 1000;
        $expected_message = 'Field: agreement does not have a valid value for Something data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * Validate Success: Invalid Field Value
     *
     * @covers  Molajo\Fieldhandler\Constraint\Something::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccessZero()
    {
        $field_name  = 'agreement';
        $field_value = 0;
        $constraint  = 'Something';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $expected_code    = 1000;
        $expected_message = 'Field: agreement does not have a valid value for Something data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Something::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name  = 'single';
        $field_value = true;
        $constraint  = 'Something';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Something::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeSucceed()
    {
        $field_name  = 'alias';
        $field_value = 0;
        $constraint  = 'Something';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Something::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeFailure()
    {
        $field_name  = 'single';
        $field_value = true;
        $constraint  = 'Something';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     * @return  void
     * @since   1.0.0
     */
    public function testFormatSucceed()
    {
        $field_name  = 'single';
        $field_value = 0;
        $constraint  = 'Something';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     * @return  void
     * @since   1.0.0
     */
    public function testFormatFailure()
    {
        $field_name  = 'single';
        $field_value = true;
        $constraint  = 'Something';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * Tear down
     *
     * @return void
     * @since   1.0.0
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
