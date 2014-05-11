<?php
/**
 * Length Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Length Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class LengthTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Length::validate
     * @covers  Molajo\Fieldhandler\Constraint\Length::validation
     * @covers  Molajo\Fieldhandler\Constraint\Length::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Length::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrue()
    {
        $field_name                = 'fieldname';
        $field_value               = 'dogfood';
        $constraint                = 'Length';
        $options                   = array();
        $options['minimum_length'] = 0;
        $options['maximum_length'] = 10;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Length::validate
     * @covers  Molajo\Fieldhandler\Constraint\Length::validation
     * @covers  Molajo\Fieldhandler\Constraint\Length::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Length::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name                = 'fieldname';
        $field_value               = 'dogfood is not good to eat.';
        $constraint                = 'Length';
        $options                   = array();
        $options['minimum_length'] = 0;
        $options['maximum_length'] = 10;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 8000;
        $expected_message = 'Field: fieldname did not pass the Length data type test.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Length::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Length::validate
     * @covers  Molajo\Fieldhandler\Constraint\Length::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name                = 'fieldname';
        $field_value               = 'dogfood is not good to eat.';
        $constraint                = 'Length';
        $options                   = array();
        $options['minimum_length'] = 0;
        $options['maximum_length'] = 999;

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Length::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Length::validate
     * @covers  Molajo\Fieldhandler\Constraint\Length::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name                = 'fieldname';
        $field_value               = 'dogfood is not good to eat.';
        $constraint                = 'Length';
        $options                   = array();
        $options['minimum_length'] = 0;
        $options['maximum_length'] = 10;

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Length::format
     * @covers  Molajo\Fieldhandler\Constraint\Length::validate
     * @covers  Molajo\Fieldhandler\Constraint\Length::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name                = 'fieldname';
        $field_value               = 'dogfood is not good to eat.';
        $constraint                = 'Length';
        $options                   = array();
        $options['minimum_length'] = 0;
        $options['maximum_length'] = 0;

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
