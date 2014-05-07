<?php
/**
 * Request Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use CommonApi\Exception\UnexpectedValueException;
use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * Request Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class RequestTest extends PHPUnit_Framework_TestCase
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
     * @return  void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $request_templates = array(
            1000  => 'Field: {field_name} does not have a valid value for {constraint} data type.',
            2000  => 'Field: {field_name} must only contain {constraint} values.',
            3000  => 'Field: {field_name} is not an array.',
            4000  => 'Field: {field_name} has an invalid array element value.',
            5000  => 'Field: {field_name} has an invalid array key entry.',
            6000  => 'Field: {field_name} does not have the correct number of array values.',
            7000  => 'Field: {field_name} does not have a default value.',
            8000  => 'Field: {field_name} did not pass the {constraint} data type test.',
            9000  => 'Field: {field_name} does not have a valid file extension.',
            10000 => 'Field: {field_name} exceeded maximum value allowed.',
            11000 => 'Field: {field_name} is less than the minimum value allowed.',
            12000 => 'Field: {field_name} does not have a valid mime type.',
            13000 => 'Field: {field_name} value is required, but was not provided.',
            14000 => 'Field: {field_name} value {field_value} does not match a value from the list allowed.',
        );

        $this->request = new Request($request_templates);
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::setRequests
     * @return  void
     * @since   1.0.0
     */
    public function testSetRequests()
    {
        $request_codes = array(1000);

        $tokens = array();

        $tokens['field_name']  = 'Field Name';
        $tokens['field_value'] = 'abc';
        $tokens['constraint']  = 'Numeric';
        $tokens['method']      = 'sanitize';

        $results = $this->request->setRequests($request_codes, $tokens);

        $this->assertTrue(is_object($results));

        return;
    }


    /**
     * @covers  Molajo\Fieldhandler\Request::getRequestTemplate
     * @expectedException        \CommonApi\Exception\UnexpectedValueException
     * @expectedExceptionRequest Fieldhandler Request getRequestTemplate Method: Do not have template: 4444
     *
     * @since   1.0.0
     */
    public function testGetRequestTemplateException()
    {
        $request_codes = array(4444);

        $tokens = array();

        $tokens['field_name']  = 'Field Name';
        $tokens['field_value'] = 'abc';
        $tokens['constraint']  = 'Numeric';
        $tokens['method']      = 'sanitize';

        $this->request->setRequests($request_codes, $tokens);

        $results = $this->request->getRequests();

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
