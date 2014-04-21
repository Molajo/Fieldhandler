<?php
/**
 * Values Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request as request;
use PHPUnit_Framework_TestCase;

/**
 * Values Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class ValuesTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\values::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testFilterValid()
    {
        $field_name                    = 'test';
        $field_value                   = 'a';
        $constraint                    = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals('a', $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\values::handleInput
     * @return  void
     * @since   1.0.0
     */
    public function testFilterFail()
    {
        $field_name                    = 'test';
        $field_value                   = 'z';
        $constraint                    = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\values::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name                    = 'test';
        $field_value                   = 'z';
        $constraint                    = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\values::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateValid()
    {
        $field_name                    = 'test';
        $field_value                   = 'a';
        $constraint                    = 'Values';
        $options                       = array();
        $options['array_valid_values'] = array('a', 'b', 'c');

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        return;
    }
}
