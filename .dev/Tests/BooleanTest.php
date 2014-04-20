<?php
/**
 * Boolean Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request as request;
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
        $field_value = false;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        $messages = $results->getValidationMessages();
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
        $field_value = true;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        $messages = $results->getValidationMessages();
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
        $field_value = null;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        $messages = $results->getValidationMessages();
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


        $this->assertEquals(false, $results->getValidationResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: boolean_fieldname does not have a valid value for Boolean data type.';
        $messages         = $results->getValidationMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::filter
     * @return  void
     * @since   1.0.0
     */
    public function testFilter1()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = false;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFilteredValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::filter
     * @return  void
     * @since   1.0.0
     */
    public function testFilter2()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = true;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFilteredValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::filter
     * @return  void
     * @since   1.0.0
     */
    public function testFilter3()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = null;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFilteredValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::filter
     * @return void
     * @since   1.0.0
     */
    public function testFilterFail()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = 'yessireebob';
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFilteredValue());
        $this->assertEquals(true, $results->getChangeIndicator());

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
        $field_value = false;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->escape($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getEscapedValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::escape
     * @return  void
     * @since   1.0.0
     */
    public function testEscape2()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = true;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->escape($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getEscapedValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::escape
     * @return  void
     * @since   1.0.0
     */
    public function testEscape3()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = null;
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->escape($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getEscapedValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Boolean::escape
     * @return void
     * @since   1.0.0
     */
    public function testEscapeFail()
    {
        $field_name  = 'boolean_fieldname';
        $field_value = 'yessireebob';
        $constraint  = 'Boolean';
        $options     = array();

        $results = $this->request->escape($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getEscapedValue());
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
