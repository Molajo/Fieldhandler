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
     * test Validate Success
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccess1()
    {
        $field_name       = 'Agreement';
        $field_value      = 122222;
        $constraint       = 'True';
        $options          = array();
        $expected_message = 'Field: Agreement does not have a valid value for True data type.';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $message = $results->getValidateMessages();
        $this->assertEquals($expected_message, $message[1000]);
        $this->assertEquals(false, $results->getValidateResponse());

        return;
    }

    /**
     * test Validate Success2
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccess2()
    {
        $field_name  = 'agreement';
        $field_value = 'yes';
        $constraint  = 'Accepted';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        return;
    }

    /**
     * test Validate Success 3
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccess3()
    {
        $field_name  = 'agreement';
        $field_value = 'on';
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        return;
    }

    /**
     * test Validate Success 4
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSuccess4()
    {
        $field_name  = 'agreement';
        $field_value = true;
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        return;
    }

    /**
     * Test failure
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateUnsuccessful()
    {
        $field_name       = 'Agreement';
        $field_value      = 'nope';
        $constraint       = 'True';
        $options          = array();
        $expected_message = 'Field: Agreement does not have a valid value for True data type.';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $message = $results->getValidateMessages();
        $this->assertEquals($expected_message, $message[1000]);
        $this->assertEquals(false, $results->getValidateResponse());

        return;
    }

    /**
     * test Filter Success
     *
     * @covers  Molajo\Fieldhandler\Constraint\Default::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterSuccess()
    {
        $field_name  = 'agreement';
        $field_value = 'on';
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals('on', $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Default::handleInput
     *
     * @return void
     * @since   1.0.0
     */
    public function testFilterUnsuccessful()
    {
        $field_name  = 'agreement';
        $field_value = 'noway';
        $constraint  = 'True';
        $options     = array();

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getValidateResponse());

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
