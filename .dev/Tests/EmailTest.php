<?php
/**
 * Email Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Email Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class EmailTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Email::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccess()
    {
        $field_name  = 'email_address';
        $field_value = 'AmyStephen@Molajo.org';
        $constraint  = 'Email';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Email::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'email_address';
        $field_value = 'yessireebob';
        $constraint  = 'Email';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);


        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 2000;
        $expected_message = 'Field: email_address must only contain Email values.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Email::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testHandleInputSuccess()
    {
        $field_name  = 'email_address';
        $field_value = 'AmyStephen@Molajo.org';
        $constraint  = 'Email';
        $options     = array();

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Email::validate
     * @return void
     * @since   1.0.0
     */
    public function testHandleInputFail()
    {
        $field_name  = 'email_address';
        $field_value = 'yessireebob';
        $constraint  = 'Email';
        $options     = array();

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Email::validate
     * @return  void
     * @since   1.0.0
     */
    public function testHandleOutputSuccess()
    {
        $field_name                 = 'email_address';
        $field_value                = 'AmyStephen@Molajo.org';
        $constraint                 = 'Email';
        $options                    = array();
        $options['obfuscate_email'] = true;

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $obfuscate = "&#65;&#109;&#121;&#83;&#116;&#101;&#112;&#104;&#101;&#110;&#64;&#77;&#111;&#108;&#97;&#106;&#111;&#46;&#111;&#114;&#103;";

        $this->assertEquals($obfuscate, $results->getFieldValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Email::validate
     * @return void
     * @since   1.0.0
     */
    public function testEscapeFail()
    {
        $field_name  = 'email_address';
        $field_value = 'yessireebob';
        $constraint  = 'Email';
        $options     = array();

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

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
