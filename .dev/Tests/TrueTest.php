<?php
/**
 * True Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * True Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class TrueTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\True::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccess()
    {
        $field_name  = 'agreement';
        $field_value = 'yes';
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * Validate Failure: Invalid Field Value
     *
     * @covers  Molajo\Fieldhandler\Constraint\True::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFailure()
    {
        $field_name  = 'Agreement';
        $field_value = 122222;
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: Agreement does not have a valid value for True data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\True::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeSucceed()
    {
        $field_name  = 'single';
        $field_value = true;
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\True::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeFailure()
    {
        $field_name  = 'single';
        $field_value = false;
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\True::format
     * @return  void
     * @since   1.0.0
     */
    public function testFormatSucceed()
    {
        $field_name  = 'single';
        $field_value = 1;
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals(1, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\True::form
     * @return  void
     * @since   1.0.0
     */
    public function testFormatFailure()
    {
        $field_name  = 'single';
        $field_value = false;
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getFieldValue());
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
