<?php
/**
 * Float Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request as request;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Float Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class FloatTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Float::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name  = 'float_fieldname';
        $field_value = 123456789;
        $constraint  = 'Float';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Float::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate2()
    {
        $field_name  = 'float_fieldname';
        $field_value = null;
        $constraint  = 'Float';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Float::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate3()
    {
        $field_name  = 'float_fieldname';
        $field_value = 12345.6789;
        $constraint  = 'Float';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Float::validate\
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'float_fieldname';
        $field_value = 'yessireebob';
        $constraint  = 'Float';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(false, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Float::validate
     * @return  void
     * @since   1.0.0
     */
    public function testFilter1()
    {
        $field_name  = 'float_fieldname';
        $field_value = 123456789;
        $constraint  = 'Float';
        $options     = array();

        $results = $this->request->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Float::validate
     * @return  void
     * @since   1.0.0
     */
    public function testFilter2()
    {
        $field_name  = 'float_fieldname';
        $field_value = null;
        $constraint  = 'Float';
        $options     = array();

        $results = $this->request->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Float::validate
     * @return  void
     * @since   1.0.0
     */
    public function testFilter3()
    {
        $field_name  = 'float_fieldname';
        $field_value = 12345.6789;
        $constraint  = 'Float';
        $options     = array();

        $results = $this->request->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Float::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterFail()
    {
        $field_name  = 'float_fieldname';
        $field_value = 'yessireebob';
        $constraint  = 'Float';
        $options     = array();

        $results = $this->request->filter($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Float::validate
     * @return  void
     * @since   1.0.0
     */
    public function testEscape()
    {
        $field_name  = 'float_fieldname';
        $field_value = 123456789;
        $constraint  = 'Float';
        $options     = array();

        $results = $this->request->escape($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Float::validate
     * @return  void
     * @since   1.0.0
     */
    public function testEscape2()
    {
        $field_name  = 'float_fieldname';
        $field_value = null;
        $constraint  = 'Float';
        $options     = array();

        $results = $this->request->escape($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Float::validate
     * @return  void
     * @since   1.0.0
     */
    public function testEscape3()
    {
        $field_name  = 'float_fieldname';
        $field_value = 12345.6789;
        $constraint  = 'Float';
        $options     = array();

        $results = $this->request->escape($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Float::validate
     * @return void
     * @since   1.0.0
     */
    public function testEscapeFail()
    {
        $field_name  = 'float_fieldname';
        $field_value = 'yessireebob';
        $constraint  = 'Float';
        $options     = array();

        $results = $this->request->escape($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getValidationResponse());

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
