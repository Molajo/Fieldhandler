<?php
/**
 * Digit Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request as request;
use PHPUnit_Framework_TestCase;

/**
 * Digit Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class DigitTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Digit::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name  = 'digit_fieldname';
        $field_value = '1234';
        $constraint  = 'Digit';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Digit::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate2()
    {
        $field_name  = 'digit_fieldname';
        $field_value = null;
        $constraint  = 'Digit';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Digit::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'digit_fieldname';
        $field_value = 'yessireebob';
        $constraint  = 'Digit';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Digit::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testFilter1()
    {
        $field_name  = 'digit_fieldname';
        $field_value = 123;
        $constraint  = 'Digit';
        $options     = array();

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Digit::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testFilter2()
    {
        $field_name  = 'digit_fieldname';
        $field_value = 'dog';
        $constraint  = 'Digit';
        $options     = array();

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Digit::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testEscape1()
    {
        $field_name  = 'digit_fieldname';
        $field_value = 123;
        $constraint  = 'Digit';
        $options     = array();

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Digit::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testEscape2()
    {
        $field_name  = 'digit_fieldname';
        $field_value = 'dog';
        $constraint  = 'Digit';
        $options     = array();

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getValidateResponse());

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
