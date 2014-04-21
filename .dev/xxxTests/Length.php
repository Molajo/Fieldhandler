<?php
/**
 * Length Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request as request;
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
     * @covers  Molajo\Fieldhandler\Constraint\Length::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name      = 'fieldname';
        $field_value     = 'dogfood';
        $constraint      = 'Length';
        $options         = array();
        $options['from'] = 0;
        $options['to']   = 10;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Length::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name      = 'fieldname';
        $field_value     = 'dogfood is not good to eat.';
        $constraint      = 'Length';
        $options         = array();
        $options['from'] = 0;
        $options['to']   = 10;

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
