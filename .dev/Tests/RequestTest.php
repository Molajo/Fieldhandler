<?php
/**
 * Request Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Request Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class RequestTest extends PHPUnit_Framework_TestCase
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
        $message_templates = array(
            1000  => 'Field: {field_name} does not have a valid value for {constraint} data type.',
            2000  => 'Field: {field_name} must only contain {constraint} values.',
            3000  => 'Field: {field_name} is not an array.',
            4000  => 'Field: {field_name} has an invalid array element value.',
            5000  => 'Field: {field_name} has an invalid array key entry.',
            6000  => 'Field: {field_name} does not have the correct number of array values.',
            7000  => 'Field: {field_name} does not have a default value.',
            8000  => 'Field: {field_name} did not pass the {constraint} data type test.',
            9000  => 'Field: {field_name} does not have a valid file extension.',
            10000 => 'Field: {field_name} exceeded maximum value allowed.',
            11000 => 'Field: {field_name} is less than the minimum value allowed.',
            12000 => 'Field: {field_name} does not have a valid mime type.',
            13000 => 'Field: {field_name} value is required, but was not provided.',
            14000 => 'Field: {field_name} value {field_value} does not match a value from the list allowed.',
        );

        $this->request = new Request($message_templates);
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::__construct
     * @return  void
     * @since   1.0.0
     */
    public function testRequest()
    {
        $message_templates = array(
            1000  => 'Field: {field_name} does not have a valid value for {constraint} data type.',
        );

        $this->request2 = new Request2($message_templates);
        $results = $this->request2->getMessages();

        $this->assertEquals($results, $message_templates);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate()
    {
        $field_name  = 'Field Name';
        $field_value = 123;
        $constraint  = 'Mocknumeric';
        $options = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals($results->getValidateResponse(), true);
        $this->assertEquals($results->getValidateMessages(), array());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name  = 'Field Name';
        $field_value = 'Dog';
        $constraint  = 'Mocknumeric';
        $options = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals($results->getValidateResponse(), false);

        $expected_code    = 2000;
        $expected_message = 'Field: Field Name must only contain Mocknumeric values.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testSanitize()
    {
        $field_name  = 'Field Name';
        $field_value = 123;
        $constraint  = 'Mocknumeric';
        $options = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($results->getFieldValue(), 123);
        $this->assertEquals($results->getChangeIndicator(), false);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeFalse()
    {
        $field_name  = 'Field Name';
        $field_value = 'Dog';
        $constraint  = 'Mocknumeric';
        $options = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($results->getFieldValue(), null);
        $this->assertEquals($results->getChangeIndicator(), true);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::format
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name  = 'Field Name';
        $field_value = 123;
        $constraint  = 'Mocknumeric';
        $options = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($results->getFieldValue(), 123);
        $this->assertEquals($results->getChangeIndicator(), false);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::processRequest
     * @return  void
     * @since   1.0.0
     */
    public function testProcessRequest()
    {
        $field_name  = 'Field Name';
        $field_value = 123;
        $constraint  = 'Mocknumeric';
        $options = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($results->getFieldValue(), 123);
        $this->assertEquals($results->getChangeIndicator(), false);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::setFieldName
     * @expectedException        \CommonApi\Exception\UnexpectedValueException
     * @expectedExceptionRequest Fieldhandler Request: Must provide the field name.
     *
     * @since   1.0.0
     */
    public function testSetFieldName()
    {
        $field_name  = null;
        $field_value = 123;
        $constraint  = 'Mocknumeric';
        $options = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::editConstraint
     * @expectedException        \CommonApi\Exception\UnexpectedValueException
     * @expectedExceptionRequest Fieldhandler Request: Must request a specific constraint
     *
     * @since   1.0.0
     */
    public function testEditConstraint()
    {
        $field_name  = 'dog';
        $field_value = 123;
        $constraint  = '';
        $options = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::createConstraintClass
     * @expectedException        \CommonApi\Exception\UnexpectedValueException
     * @expectedExceptionRequest Fieldhandler Request createConstraint Method Failed: Dog Class: Molajo\Fieldhandler\Constraint\Dog
     *
     * @since   1.0.0
     */
    public function testCreateConstraintClass()
    {
        $field_name  = 'field_name';
        $field_value = 123;
        $constraint  = 'dog';
        $options = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

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
    }
}


class Request2 extends Request
{
    public function getMessages()
    {
        return $this->message_templates;
    }
}


namespace Molajo\Fieldhandler\Constraint;
use CommonApi\Model\ConstraintInterface;
use Exception;

/**
 * Mock Dog Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Dog extends AbstractConstraintTests implements ConstraintInterface
{
    public function __construct()
    {
        throw new Exception
        (
            'Mock Exception'
        );
    }
}
/**
 * Mock Numeric Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Mocknumeric extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 2000;

    /**
     * Validate
     *
     * Verifies that the field value contents do not contain any HTML tags or attributes
     * which are not defined in the white_list. If false, use sanitize to clean content.
     *
     * To review or override white_list, see AbstractHtml Constraint Class
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if (is_numeric($this->field_value)) {
            return true;
        }

        $this->setValidateMessage($this->message_code);

        return false;
    }

    /**
     * Sanitize
     *
     * Sanitizes the field value contents so that there are no HTML tags or attributes
     * which have not been defined in the white_list. Critical for security.
     *
     * To review or override white_list, see AbstractHtml Constraint Class
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if (is_numeric($this->field_value)) {
            return $this->field_value;
        }

        $this->field_value = null;

        return $this->field_value;
    }

    /**
     * Format
     *
     * Escapes the field value contents for presentation on the web; critical for security
     *
     * To review or override white_list, see AbstractHtml Constraint Class
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function format()
    {
        return $this->field_value;
    }
}



