<?php
/**
 * Encoded Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Encoded Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class EncodedTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSucceed()
    {
        $field_name  = 'dog';
        $field_value = 'nothing';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'dog';
        $field_value = 'my-apples&are green and red';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 8000;
        $expected_message = 'Field: dog did not pass the Encoded data type test.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testHandleInputSucceed()
    {
        $field_name  = 'dog';
        $field_value = 'my-apples&are green and red';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals('my-apples%26are%20green%20and%20red', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testHandleInputFailure()
    {
        $field_name  = 'encoded';
        $field_value = 'Jack *&and+Jill';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals('Jack%20%2A%26and%2BJill', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::handleOutput
     * @return  void
     * @since   1.0.0
     */
    public function testHandleOutputSucceed()
    {
        $field_name  = 'encoded';
        $field_value = 'Jack *&and+Jill';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $this->assertEquals('Jack%20%2A%26and%2BJill', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::handleOutput
     * @return  void
     * @since   1.0.0
     */
    public function testHandleOutputFailure()
    {
        $field_name  = 'encoded';
        $field_value = 'Jack *&and+Jill';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $this->assertEquals('Jack%20%2A%26and%2BJill', $results->getFieldValue());
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
