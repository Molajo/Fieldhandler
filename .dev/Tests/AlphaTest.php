<?php
/**
 * Alpha Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request as request;
use PHPUnit_Framework_TestCase;

/**
 * Alpha Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class AlphaTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Alpha::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSucceed()
    {
        $field_name  = 'test';
        $field_value = 'AbCdEfG';
        $constraint  = 'Alpha';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alpha::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'test';
        $field_value = '@Aa123';
        $constraint  = 'Alpha';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 2000;
        $expected_message = 'Field: test must only contain Alpha values.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alpha::handleInput
     * @return void
     * @since   1.0.0
     */
    public function testFilterNoChange()
    {
        $field_name  = 'test';
        $field_value = 'AbCdEfG';
        $constraint  = 'Alpha';
        $options     = array();

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alpha::handleInput
     * @return void
     * @since   1.0.0
     */
    public function testFilterChange()
    {
        $field_name  = 'test';
        $field_value = '@Aa123';
        $constraint  = 'Alpha';
        $options     = array();

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $expected_value = 'Aa';
        $this->assertEquals($expected_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alpha::handleInput
     * @return void
     * @since   1.0.0
     */
    public function testEscapeChange()
    {
        $field_name  = 'test';
        $field_value = '1A2b3C4d5E6f7G8';
        $constraint  = 'Alpha';
        $options     = array();

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $field_value = 'AbCdEfG';
        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alpha::handleInput
     * @return void
     * @since   1.0.0
     */
    public function testEscapeNoChange()
    {
        $field_name  = 'test';
        $field_value = 'Aa';
        $constraint  = 'Alpha';
        $options     = array();

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
