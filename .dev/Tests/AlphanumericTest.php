<?php
/**
 * Alphanumeric Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;

use PHPUnit_Framework_TestCase;

/**
 * Alphanumeric Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class AlphanumericTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Alphanumeric::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidationSucceed()
    {
        $field_name  = 'test';
        $field_value = 'Aa123';
        $constraint  = 'Alphanumeric';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alphanumeric::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidationFail()
    {
        $field_name  = 'test';
        $field_value = '@Aa123';
        $constraint  = 'Alphanumeric';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 2000;
        $expected_message = 'Field: test must only contain Alphanumeric values.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alphanumeric::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testFilterValid()
    {
        $field_name  = 'test';
        $field_value = 'Aa123';
        $constraint  = 'Alphanumeric';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alphanumeric::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testFilterFail()
    {
        $field_name  = 'test';
        $field_value = '@Aa123';
        $constraint  = 'Alphanumeric';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $expected_value = 'Aa123';
        $this->assertEquals($expected_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alphanumeric::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testEscapeValid()
    {
        $field_name  = 'test';
        $field_value = 'Aa123';
        $constraint  = 'Alphanumeric';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alphanumeric::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testEscapeFail()
    {
        $field_name  = 'test';
        $field_value = '@Aa123';
        $constraint  = 'Alphanumeric';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $field_value = 'Aa123';
        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }
}
