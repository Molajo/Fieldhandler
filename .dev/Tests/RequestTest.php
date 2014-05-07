<?php
/**
 * Request Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use CommonApi\Exception\UnexpectedValueException;
use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;
use stdClass;

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
     * @covers  Molajo\Fieldhandler\Request::getRequestTemplate
     * @expectedException        \CommonApi\Exception\UnexpectedValueException
     * @expectedExceptionRequest Fieldhandler Request getRequestTemplate Method: Do not have template: 4444
     *
     * @since   1.0.0
     */
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

namespace Molajo\Fieldhandler\Constraint;
use CommonApi\Model\ConstraintInterface;

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
