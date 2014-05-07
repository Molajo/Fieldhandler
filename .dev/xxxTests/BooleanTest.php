<?php
/**
 * Boolean Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Boolean Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class BooleanTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccessFalse()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = FALSE;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(TRUE, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccessTrue()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = TRUE;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(TRUE, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccessNull()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = NULL;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(TRUE, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = 'yessireebob';
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);


        $this->assertEquals(FALSE, $results->getValidateResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: boolean_fieldname does not have a valid value for Boolean data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testFilter1()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = FALSE;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testFilter2()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = TRUE;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testFilter3()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = NULL;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::sanitize
     * @return void
     * @since   1.0.0
     */
    public function testFilterFail()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = 'yessireebob';
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(NULL, $results->getFieldValue());
        $this->assertEquals(TRUE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::escape
     * @return  void
     * @since   1.0.0
     */
    public function testEscape1()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = FALSE;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals(NULL, $results->getFieldValue());
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
