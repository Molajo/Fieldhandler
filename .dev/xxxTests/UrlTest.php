<?php
/**
 * Url Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Url Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class UrlTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Url::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name  = 'url_field';
        $field_value = 'http://google.com/';
        $constraint  = 'Url';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Url::validate
     * @return void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name  = 'url_field';
        $field_value = ' $-_.+!';
        $constraint  = 'Url';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);
        $this->assertEquals(false, $results->getValidateResponse());
        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Url::validate
     * @return  void
     * @since   1.0.0
     */
    public function testFilter1()
    {
        $field_name  = 'url_field';
        $field_value = 'http://google.com/';
        $constraint  = 'Url';
        $options     = array();

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Url::validate
     * @return void
     * @since   1.0.0
     */
    public function testFilterFail()
    {
        $field_name                            = 'url_field';
        $field_value                           = 'yessireebob';
        $constraint                            = 'Url';
        $options                               = array();
        $options['FILTER_FLAG_PATH_REQUIRED']  = true;
        $options['FILTER_FLAG_QUERY_REQUIRED'] = true;

        $results = $this->request->handleInput($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Url::validate
     * @return  void
     * @since   1.0.0
     */
    public function testEscape1()
    {
        $field_name  = 'url_field';
        $field_value = 'http://google.com/';
        $constraint  = 'Url';
        $options     = array();

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getValidateResponse());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Url::validate
     * @return void
     * @since   1.0.0
     */
    public function testEscapeFail()
    {
        $field_name                  = 'url_field';
        $field_value                 = 'yessireebob';
        $constraint                  = 'Url';
        $options                     = array();
        $options['FILTER_FLAG_IPV6'] = true;

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, $options);

        $this->assertEquals(null, $results->getValidateResponse());

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
