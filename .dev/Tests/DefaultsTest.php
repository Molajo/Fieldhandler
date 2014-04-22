<?php
/**
 * Defaults Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request as request;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Defaults Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class DefaultsTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidatePass()
    {
        $field_name  = 'dog';
        $field_value = null;
        $constraint  = 'Defaults';
        $options     = array(
            'default' => 'bark'
        );

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 7000;
        $expected_message = 'Field: dog does not have a default value.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::validate
     * @return void
     * @since   1.0.0
     */
    public function testHandleInputSuccess()
    {
        $field_name  = 'dog';
        $field_value = null;
        $constraint  = 'Defaults';
        $options     = array(
            'default' => 'bark'
        );

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals('bark', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidApplyDefaultThenValidate()
    {
        $field_name  = 'cat';
        $field_value = null;
        $constraint  = 'Defaults';
        $options     = array(
            'default' => 'bark'
        );

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $field_value = 'bark';
        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

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
