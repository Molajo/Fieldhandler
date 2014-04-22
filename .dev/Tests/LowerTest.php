<?php
/**
 * lower Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * lower Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class LowerTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\lower::validate
     * @return  void
     * @since   1.0.0
     */
    public function testHandleInputSuccess()
    {
        $field_name  = 'test';
        $field_value = 'aa123';
        $constraint  = 'Lower';
        $options     = array();

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals('aa123', $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\lower::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'test';
        $field_value = 'Aa123';
        $constraint  = 'Lower';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $expected_code    = 2000;
        $expected_message = 'Field: test must only contain Lower values.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }
}
