<?php
/**
 * HTML Constraint Test
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
 * Fullspecialchars Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class HtmlTest extends PHPUnit_Framework_TestCase
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
     * Test HTML filter
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFilter()
    {
        $field_name  = 'fieldname';
        $field_value = '<script>("Gotcha!");</script><p>I am fine.</p>';
        $constraint  = 'Html';
        $filtered    = '("Gotcha!");<p>I am fine.</p>';

        $results = $this->request->filter($field_name, $field_value, $constraint, array());

        $this->assertEquals($filtered, $results->getValidationResponse());

        return;
    }

    /**
     * Test Validate
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidate()
    {
        $field_name  = 'fieldname';
        $field_value = '<p>Yup.</p>';
        $constraint  = 'Html';

        $results = $this->request->validate($field_name, $field_value, $constraint, array());

        $this->assertEquals(true, $results->getValidationResponse());

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
