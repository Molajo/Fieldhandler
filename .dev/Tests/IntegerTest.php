<?php
/**
 * Integer Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Integer Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class IntegerTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Integer::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccess()
    {
        $field_name  = 'digit_fieldname';
        $field_value = 1234;
        $constraint  = 'Integer';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(TRUE, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Integer::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate2()
    {
        $field_name  = 'digit_fieldname';
        $field_value = NULL;
        $constraint  = 'Integer';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(TRUE, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Integer::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'digit_fieldname';
        $field_value = 'yessireebob';
        $constraint  = 'Integer';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(FALSE, $results->getValidateResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: digit_fieldname does not have a valid value for Integer data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Integer::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeSuccess()
    {
        $field_name  = 'digit_fieldname';
        $field_value = 123;
        $constraint  = 'Integer';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Integer::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeFail()
    {
        $field_name  = 'digit_fieldname';
        $field_value = 'dog';
        $constraint  = 'Integer';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $field_value = NULL;
        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(TRUE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Integer::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testFormatSuccess()
    {
        $field_name  = 'digit_fieldname';
        $field_value = 'dog';
        $constraint  = 'Integer';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

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
