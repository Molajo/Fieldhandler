<?php
/**
 * Callback Constraint Test
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
 * Callback Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class CallbackTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Callback::validate
     * @covers  Molajo\Fieldhandler\Constraint\Callback::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Callback::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\Callback::validateCompare
     * @covers  Molajo\Fieldhandler\Constraint\Callback::sanitizeValidate
     * @covers  Molajo\Fieldhandler\Constraint\Callback::setCallback
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccess()
    {
        $field_name          = 'attention';
        $field_value         = 'DOG';
        $constraint          = 'Callback';
        $options             = array();
        $options['callback'] = 'strtoupper';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Callback::validate
     * @covers  Molajo\Fieldhandler\Constraint\Callback::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Callback::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\Callback::validateCompare
     * @covers  Molajo\Fieldhandler\Constraint\Callback::sanitizeValidate
     * @covers  Molajo\Fieldhandler\Constraint\Callback::setCallback
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name          = 'attention';
        $field_value         = 'DOG';
        $constraint          = 'Callback';
        $options             = array();
        $options['callback'] = 'strtolower';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $expected_code    = 1000;
        $expected_message = 'Field: attention does not have a valid value for Callback data type.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Callback::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Callback::setCallback
     * @covers  Molajo\Fieldhandler\Constraint\Callback::validateCompare
     * @covers  Molajo\Fieldhandler\Constraint\Callback::sanitizeValidate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlags
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlag
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name          = 'attention';
        $field_value         = 'DOG';
        $constraint          = 'Callback';
        $options             = array();
        $options['callback'] = 'strtoupper';

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Callback::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Callback::setCallback
     * @covers  Molajo\Fieldhandler\Constraint\Callback::validateCompare
     * @covers  Molajo\Fieldhandler\Constraint\Callback::sanitizeValidate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlags
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlag
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name          = 'attention';
        $field_value         = 'DOG';
        $constraint          = 'Callback';
        $options             = array();
        $options['callback'] = 'strtolower';

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals('dog', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Callback::format
     * @covers  Molajo\Fieldhandler\Constraint\Callback::setCallback
     * @covers  Molajo\Fieldhandler\Constraint\Callback::validateCompare
     * @covers  Molajo\Fieldhandler\Constraint\Callback::sanitizeValidate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlags
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlag
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormatNoChange()
    {
        $field_name          = 'attention';
        $field_value         = 'DOG';
        $constraint          = 'Callback';
        $options             = array();
        $options['callback'] = 'strtoupper';

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Callback::format
     * @covers  Molajo\Fieldhandler\Constraint\Callback::setCallback
     * @covers  Molajo\Fieldhandler\Constraint\Callback::validateCompare
     * @covers  Molajo\Fieldhandler\Constraint\Callback::sanitizeValidate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlags
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlag
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormatChange()
    {
        $field_name          = 'attention';
        $field_value         = 'DOG';
        $constraint          = 'Callback';
        $options             = array();
        $options['callback'] = 'strtolower';

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals('dog', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }
}
