<?php
/**
 * Equal Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Equal Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class EqualTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Equal::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSucceed()
    {
        $field_name        = 'field1';
        $field_value       = 'dog';
        $constraint        = 'Equal';
        $options           = array();
        $options['equals'] = 'dog';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(TRUE, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equal::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name        = 'field1';
        $field_value       = 'dog';
        $constraint        = 'Equal';
        $options           = array();
        $options['equals'] = 'cat';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(FALSE, $results->getValidateResponse());

        $expected_code    = 8000;
        $expected_message = 'Field: field1 did not pass the Equal data type test.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equal::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeSucceed()
    {
        $field_name        = 'field1';
        $field_value       = 'dog';
        $constraint        = 'Equal';
        $options           = array();
        $options['equals'] = 'dog';

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals('dog', $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equal::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeFailure()
    {
        $field_name        = 'field1';
        $field_value       = 'dog';
        $constraint        = 'Equal';
        $options           = array();
        $options['equals'] = 'cat';

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(NULL, $results->getFieldValue());
        $this->assertEquals(TRUE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equal::format
     * @return  void
     * @since   1.0.0
     */
    public function testFormatSucceed()
    {
        $field_name        = 'field1';
        $field_value       = 'dog';
        $constraint        = 'Equal';
        $options           = array();
        $options['equals'] = 'dog';

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals('dog', $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Equal::format
     * @return  void
     * @since   1.0.0
     */
    public function testFormatFailure()
    {
        $field_name        = 'field1';
        $field_value       = 'dog';
        $constraint        = 'Equal';
        $options           = array();
        $options['equals'] = 'cat';

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

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
