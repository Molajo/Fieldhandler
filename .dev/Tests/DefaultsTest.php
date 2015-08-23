<?php
/**
 * Defaults Constraint Test
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Defaults Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class DefaultsTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::validate
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrue()
    {
        $field_name  = 'dog';
        $field_value = 'barks';
        $constraint  = 'Defaults';

        $results = $this->request->validate($field_name, $field_value, $constraint);

        $this->assertEquals(true, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::validate
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name  = 'dog';
        $field_value = null;
        $constraint  = 'Defaults';

        $results = $this->request->validate($field_name, $field_value, $constraint);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 7000;
        $expected_message = 'Field: dog does not have a default value.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name  = 'dog';
        $field_value = 'bark';
        $constraint  = 'Defaults';
        $options     = array(
            'default' => 'bark'
        );

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name  = 'dog';
        $field_value = null;
        $constraint  = 'Defaults';
        $options     = array(
            'default' => 'bark'
        );

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals('bark', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name  = 'cat';
        $field_value = null;
        $constraint  = 'Defaults';
        $options     = array(
            'default' => 'meow'
        );

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::validate
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Defaults::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidApplyDefaultThenValidate()
    {
        $field_name  = 'cat';
        $field_value = null;
        $constraint  = 'Defaults';
        $options     = array(
            'default' => 'meow'
        );

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $field_value = 'meow';
        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }
}
