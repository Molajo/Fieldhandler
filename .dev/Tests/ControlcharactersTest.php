<?php
/**
 * ControlCharacters Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * ControlCharacters Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class ControlCharactersTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\ControlCharacters::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateSucceed()
    {
        $field_name  = 'test';
        $field_value = "\n\r\t";
        $constraint  = 'Controlcharacters';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(TRUE, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\ControlCharacters::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'test';
        $field_value = "xyz\n\r\t";
        $constraint  = 'Controlcharacters';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(FALSE, $results->getValidateResponse());

        $expected_code    = 2000;
        $expected_message = 'Field: test must only contain Controlcharacters values.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\ControlCharacters::sanitize
     * @return void
     * @since   1.0.0
     */
    public function testFilterNoChange()
    {
        $field_name  = 'test';
        $field_value = "\n\r\t";
        $constraint  = 'Controlcharacters';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\ControlCharacters::sanitize
     * @return void
     * @since   1.0.0
     */
    public function testFilterChange()
    {
        $field_name  = 'test';
        $field_value = "xyz\n\r\t";
        $constraint  = 'Controlcharacters';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $expected_value = "\n\r\t";
        $this->assertEquals($expected_value, $results->getFieldValue());
        $this->assertEquals(TRUE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\ControlCharacters::sanitize
     * @return void
     * @since   1.0.0
     */
    public function testEscapeNoChange1()
    {
        $field_name  = 'test';
        $field_value = '1A2b3C4d5E6f7G8';
        $constraint  = 'Controlcharacters';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

        return;
    }
}
