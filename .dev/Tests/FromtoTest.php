<?php
/**
 * Fromto Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Fromto Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class FromtoTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Fromto::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSucceed()
    {
        $field_name      = 'fieldname';
        $field_value     = 5;
        $constraint      = 'Fromto';
        $options         = array();
        $options['from'] = 0;
        $options['to']   = 10;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Fromto::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name      = 'fieldname';
        $field_value     = 500;
        $constraint      = 'Fromto';
        $options         = array();
        $options['from'] = 0;
        $options['to']   = 10;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 8000;
        $expected_message = 'Field: fieldname did not pass the Fromto data type test.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Fromto::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testHandleInputSucceed()
    {
        $field_name      = 'fieldname';
        $field_value     = 5;
        $constraint      = 'Fromto';
        $options         = array();
        $options['from'] = 0;
        $options['to']   = 10;

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Fromto::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testHandleInputFailure()
    {
        $field_name      = 'fieldname';
        $field_value     = 500;
        $constraint      = 'Fromto';
        $options         = array();
        $options['from'] = 0;
        $options['to']   = 10;

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Fromto::handleOutput
     * @return  void
     * @since   1.0.0
     */
    public function testHandleOutputSucceed()
    {
        $field_name      = 'fieldname';
        $field_value     = 5;
        $constraint      = 'Fromto';
        $options         = array();
        $options['from'] = 0;
        $options['to']   = 10;

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Fromto::handleOutput
     * @return  void
     * @since   1.0.0
     */
    public function testHandleOutputFailure()
    {
        $field_name      = 'fieldname';
        $field_value     = 500;
        $constraint      = 'Fromto';
        $options         = array();
        $options['from'] = 0;
        $options['to']   = 10;

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
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
