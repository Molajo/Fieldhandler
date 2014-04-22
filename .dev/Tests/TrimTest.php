<?php
/**
 * Trim Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Trim Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class TrimTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Trim::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccess()
    {
        $field_name  = 'req';
        $field_value = 'AmyStephen@Molajo.org';
        $constraint  = 'Trim';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Trim::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'email';
        $field_value = 'AmyStephen@Molajo.org                ';
        $constraint  = 'Trim';

        $results = $this->request->validate($field_name, $field_value, $constraint, array());

        $expected_code    = 8000;
        $expected_message = 'Field: email did not pass the Trim data type test.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Trim::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail2()
    {
        $field_name  = 'req';
        $field_value = '            AmyStephen@Molajo.org           ';
        $constraint  = 'Trim';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals('AmyStephen@Molajo.org', $results->getFieldValue());
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
