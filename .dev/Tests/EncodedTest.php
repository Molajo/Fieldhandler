<?php
/**
 * Encoded Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Encoded Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class EncodedTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::validate
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSucceed()
    {
        $field_name  = 'dog';
        $field_value = 'nothing';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::validate
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'dog';
        $field_value = 'my-apples&are green and red';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 2000;
        $expected_message = 'Field: dog must only contain Encoded values.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::sanitize
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
        $field_name  = 'dog';
        $field_value = 'my-apples&are green and red';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals('my-apples%26are%20green%20and%20red', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlags
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlag
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name  = 'encoded';
        $field_value = 'Jack *&and+Jill';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals('Jack%20%2A%26and%2BJill', $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Encoded::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractFiltervar::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlags
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::setFlag
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name  = 'encoded';
        $field_value = 'Jack *&and+Jill';
        $constraint  = 'Encoded';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals('Jack *&and+Jill', $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

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
