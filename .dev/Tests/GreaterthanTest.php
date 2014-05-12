<?php
/**
 * Greaterthan Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Greaterthan Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class GreaterthanTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::validate
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::validation
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testGreaterthan
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrue()
    {
        $field_name              = 'fieldname';
        $field_value             = 10;
        $constraint              = 'Greaterthan';
        $options                 = array();
        $options['greater_than'] = 8;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::validate
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::validation
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testGreaterthan
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrueAlpha()
    {
        $field_name              = 'fieldname';
        $field_value             = 'z';
        $constraint              = 'Greaterthan';
        $options                 = array();
        $options['greater_than'] = 'a';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::validate
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::validation
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testGreaterthan
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name              = 'fieldname';
        $field_value             = 100;
        $constraint              = 'Greaterthan';
        $options                 = array();
        $options['greater_than'] = 500;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::validate
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::validation
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testGreaterthan
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalseEquals()
    {
        $field_name              = 'fieldname';
        $field_value             = 10;
        $constraint              = 'Greaterthan';
        $options                 = array();
        $options['greater_than'] = 10;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testGreaterthan
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name              = 'field1';
        $field_value             = 10;
        $constraint              = 'Greaterthan';
        $options                 = array();
        $options['greater_than'] = 1;

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testGreaterthan
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name              = 'field1';
        $field_value             = 1;
        $constraint              = 'Greaterthan';
        $options                 = array();
        $options['greater_than'] = 10;

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Greaterthan::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name              = 'field1';
        $field_value             = 'dog';
        $constraint              = 'Greaterthan';
        $options                 = array();
        $options['greater_than'] = 'dog';

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
