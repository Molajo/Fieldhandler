<?php
/**
 * Notequal Constraint Test
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
 * Notequal Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class NotequalTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Equals::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'cat';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'dog';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::filter
     * @return  void
     * @since   1.0.0
     */
    public function testFilter1()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'cat';

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::handleInput
     * @return void
     * @since   1.0.0
     */
    public function testFilterFail()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'dog';

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::escape
     * @return  void
     * @since   1.0.0
     */
    public function testEscape1()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'cat';

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::escape
     * @return void
     * @since   1.0.0
     */
    public function testEscapeFail()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'dog';

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getValidateResponse());

        return;
    }
}
