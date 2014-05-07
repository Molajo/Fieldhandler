<?php
/**
 * HTML Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Html Fieldhandler
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
     * Test Validate
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccess()
    {
        $field_name  = 'fieldname';
        $field_value = '<p>Yup.</p>';
        $constraint  = 'Html';

        $results = $this->request->validate($field_name, $field_value, $constraint, array());

        $this->assertEquals(TRUE, $results->getValidateResponse());

        return;
    }

    /**
     * Test HTML filter
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeSuccess()
    {
        $field_name  = 'fieldname';
        $field_value = '<script>("Gotcha!");</script><p>I am fine.</p>';
        $constraint  = 'Html';
        $filtered    = '("Gotcha!");<p>I am fine.</p>';

        $results = $this->request->sanitize($field_name, $field_value, $constraint, array());

        $this->assertEquals($filtered, $results->getFieldValue());
        $this->assertEquals(TRUE, $results->getChangeIndicator());

        return;
    }

    /**
     * Test HTML filter
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFilterSuccess()
    {
        $field_name  = 'fieldname';
        $field_value = '<script>("Gotcha!");</script><p>I am fine.</p>';
        $constraint  = 'Html';

        $results = $this->request->format($field_name, $field_value, $constraint, array());

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

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
