<?php
/**
 * Notequal Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
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
    public function testValidateSuccess()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'cat';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(TRUE, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

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

        $expected_code    = 1000;
        $expected_message = 'Field: field1 does not have a valid value for Notequal data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::filter
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeSuccess()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'cat';

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals('dog', $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::sanitize
     * @return void
     * @since   1.0.0
     */
    public function testSanitizeFail()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'dog';

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(NULL, $results->getFieldValue());
        $this->assertEquals(TRUE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::escape
     * @return  void
     * @since   1.0.0
     */
    public function testFormatSucceed()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'cat';

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals('dog', $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equals::escape
     * @return void
     * @since   1.0.0
     */
    public function testFormatFail()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'dog';

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $field_value = NULL;
        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(TRUE, $results->getChangeIndicator());

        return;
    }
}