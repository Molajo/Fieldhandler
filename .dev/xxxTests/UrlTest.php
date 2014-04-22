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
    public function testValidateSuccess()
    {
        $field_name  = 'url_field';
        $field_value = 'http://google.com/';
        $constraint  = 'Url';
        $options     = array();

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

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

        $expected_code    = 8000;
        $expected_message = 'Field: url_field did not pass the Url data type test.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Url::validate
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeSuccess()
    {
        $field_name  = 'url_field';
        $field_value = 'http://google.com/';
        $constraint  = 'Url';
        $options     = array();

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Url::validate
     * @return void
     * @since   1.0.0
     */
    public function testSanitizeFail()
    {
        $field_name                            = 'url_field';
        $field_value                           = 'yessireebob';
        $constraint                            = 'Url';
        $options                               = array();
        $options['FILTER_FLAG_PATH_REQUIRED']  = true;
        $options['FILTER_FLAG_QUERY_REQUIRED'] = true;

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Url::validate
     * @return  void
     * @since   1.0.0
     */
    public function testFormatSuccess()
    {
        $field_name  = 'url_field';
        $field_value = 'http://google.com/';
        $constraint  = 'Url';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Url::validate
     * @return void
     * @since   1.0.0
     */
    public function testFormatFail()
    {
        $field_name                  = 'url_field';
        $field_value                 = 'yessireebob';
        $constraint                  = 'Url';
        $options                     = array();
        $options['FILTER_FLAG_IPV6'] = true;

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $field_value = null;
        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

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
