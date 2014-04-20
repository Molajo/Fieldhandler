<?php
/**
 * Date Constraint Test
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
 * Date Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class DateTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Date::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = 'gggghhhhhh';

        $constraint = 'Date';

        $results = $this->request->validate($field_name, $field_value, $constraint);

        $this->assertEquals(false, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::filter
     * @return  void
     * @since   1.0.0
     */
    public function testFilterSuccess2()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = '2013/04/01 01:00:00';
        $constraint  = 'Date';

        $results = $this->request->filter($field_name, $field_value, $constraint);

        $this->assertEquals($field_value, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::validate
     * @return  void
     * @since   1.0.0
     */
    public function testFilterFailwNull()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = 'gggghhhhhh';

        $constraint = 'Date';

        $results = $this->request->filter($field_name, $field_value, $constraint);

        $field_value = null;
        $this->assertEquals($field_value, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::validate
     * @return  void
     * @since   1.0.0
     */
    public function testFilterSuccess()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = '2013/04/01 01:00:00';
        $constraint  = 'Date';

        $results = $this->request->filter($field_name, $field_value, $constraint);

        $this->assertEquals($field_value, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::validate
     * @return  void
     * @since   1.0.0
     */
    public function testEscapeFailwNull()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = 'gggghhhhhh';

        $constraint = 'Date';

        $results = $this->request->escape($field_name, $field_value, $constraint);

        $field_value = null;
        $this->assertEquals($field_value, $results->getValidationResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Date::validate
     * @return  void
     * @since   1.0.0
     */
    public function testEscapeSuccess()
    {
        $field_name  = 'this_is_a_date_field';
        $field_value = '2013/04/01 01:00:00';
        $constraint  = 'Date';

        $results = $this->request->escape($field_name, $field_value, $constraint);

        $this->assertEquals($field_value, $results->getValidationResponse());

        return;
    }
}
