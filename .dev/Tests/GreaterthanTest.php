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
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getGreaterthan
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccess()
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
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getGreaterthan
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateAlpha()
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
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getGreaterthan
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail()
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
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getOption
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::getGreaterthan
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail2()
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
     * Tear down
     *
     * @return void
     * @since   1.0.0
     */
    protected function tearDown()
    {
    }
}
