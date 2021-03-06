<?php
/**
 * Trim Constraint Test
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Trim Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class TrimTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Trim::validate
     * @covers  Molajo\Fieldhandler\Constraint\Trim::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Trim::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrue()
    {
        $field_name                       = 'test';
        $field_value                      = "Trimmed.";
        $constraint                       = 'Trim';
        $options                          = array();
        $options['allow_space_character'] = true;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Trim::validate
     * @covers  Molajo\Fieldhandler\Constraint\Trim::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Trim::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name                       = 'test';
        $field_value                      = " This is not trimmed. ";
        $constraint                       = 'Trim';
        $options                          = array();
        $options['allow_space_character'] = true;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 2000;
        $expected_message = 'Field: test must only contain Trim values.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Trim::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name                       = 'test';
        $field_value                      = "This is trimmed.";
        $constraint                       = 'Trim';
        $options                          = array();
        $options['allow_space_character'] = true;

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Trim::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name                       = 'test';
        $field_value                      = " This is not trimmed. ";
        $constraint                       = 'Trim';
        $options                          = array();
        $options['allow_space_character'] = true;

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $expected_value = "This is not trimmed.";
        $this->assertEquals($expected_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Trim::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormatNoChange()
    {
        $field_name                       = 'test';
        $field_value                      = "This is trimmed.";
        $constraint                       = 'Trim';
        $options                          = array();
        $options['allow_space_character'] = true;

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Trim::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormatChange()
    {
        $field_name                       = 'test';
        $field_value                      = " This is not trimmed. ";
        $constraint                       = 'Trim';
        $options                          = array();
        $options['allow_space_character'] = true;

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $expected_value = "This is not trimmed.";
        $this->assertEquals($expected_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }
}
