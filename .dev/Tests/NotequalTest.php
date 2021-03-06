<?php
/**
 * Notequal Constraint Test
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
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
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
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
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::validate
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::validation
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testNotequal
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrue()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'cat';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::validate
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::validation
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testNotequal
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'dog';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $expected_code    = 8000;
        $expected_message = 'Field: field1 did not pass the Notequal data type test.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testNotequal
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'cat';

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals('dog', $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testNotequal
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'dog';

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Notequal::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Notequal';
        $options              = array();
        $options['not_equal'] = 'cat';

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals('dog', $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
