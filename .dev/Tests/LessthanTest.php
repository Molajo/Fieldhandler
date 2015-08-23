<?php
/**
 * Lessthan Constraint Test
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Lessthan Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class LessthanTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::validate
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::validation
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testLessthan
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrue()
    {
        $field_name           = 'fieldname';
        $field_value          = 8;
        $constraint           = 'Lessthan';
        $options              = array();
        $options['less_than'] = 10;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::validate
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::validation
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testLessthan
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrueAlpha()
    {
        $field_name           = 'fieldname';
        $field_value          = 'a';
        $constraint           = 'Lessthan';
        $options              = array();
        $options['less_than'] = 'z';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::validate
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::validation
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testLessthan
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name           = 'fieldname';
        $field_value          = 500;
        $constraint           = 'Lessthan';
        $options              = array();
        $options['less_than'] = 100;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::validate
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::validation
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::testLessthan
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalseEquals()
    {
        $field_name           = 'fieldname';
        $field_value          = 10;
        $constraint           = 'Lessthan';
        $options              = array();
        $options['less_than'] = 10;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name           = 'field1';
        $field_value          = 1;
        $constraint           = 'Lessthan';
        $options              = array();
        $options['less_than'] = 10;

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name           = 'field1';
        $field_value          = 10;
        $constraint           = 'Lessthan';
        $options              = array();
        $options['less_than'] = 1;

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Lessthan::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name           = 'field1';
        $field_value          = 'dog';
        $constraint           = 'Lessthan';
        $options              = array();
        $options['less_than'] = 'dog';

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
