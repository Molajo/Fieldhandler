<?php
/**
 * Alias Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Alias Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class AliasTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Alias::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'alias';
        $field_value = 'Jack and Jill';
        $constraint  = 'Alias';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidationResponse());

        $expected_code    = 1000;
        $expected_message = 'Field: alias does not have a valid value for Alias data type.';
        $messages         = $results->getValidationMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alias::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSucceed()
    {
        $field_name  = 'alias';
        $field_value = 'jack-and-jill';
        $constraint  = 'Alias';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        $messages         = $results->getValidationMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alias::filter
     * @return void
     * @since   1.0.0
     */
    public function testFilterSucceed()
    {
        $field_name  = 'alias';
        $field_value = 'Jack and Jill';
        $constraint  = 'Alias';
        $options     = array();

        $results = $this->request->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals('jack-and-jill', $results->getFilteredValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alias::escape
     * @return void
     * @since   1.0.0
     */
    public function testFilterFailure()
    {
        $field_name  = 'alias';
        $field_value = 'Jack *&and+Jill';
        $constraint  = 'Alias';
        $options     = array();

        $results = $this->request->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals('jack-and-jill', $results->getFilteredValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alias::escape
     * @return  void
     * @since   1.0.0
     */
    public function testEscapeSucceed()
    {
        $field_name  = 'alias';
        $field_value = 'Jack *&and+Jill';
        $constraint  = 'Alias';
        $options     = array();

        $results = $this->request->escape($field_name, $field_value, $constraint, $options);

        $this->assertEquals('jack-and-jill', $results->getEscapedValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Alias::escape
     * @return void
     * @since   1.0.0
     */
    public function testEscapeFailure()
    {
        $field_name  = 'alias';
        $field_value = 'Jack *&and+Jill';
        $constraint  = 'Alias';
        $options     = array();

        $results = $this->request->escape($field_name, $field_value, $constraint, $options);

        $this->assertEquals('jack-and-jill', $results->getEscapedValue());
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
