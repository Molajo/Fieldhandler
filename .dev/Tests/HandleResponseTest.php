<?php
/**
 * HandleResponse Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\HandleResponse;
use PHPUnit_Framework_TestCase;

/**
 * HandleResponse Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class HandleResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * Escape
     *
     * @var    object  Molajo\Fieldhandler\Escape
     * @since  1.0.0
     */
    protected $handle_response;

    /**
     * Set up
     *
     * @return  void
     * @since   1.0.0
     */
    protected function setUp()
    {

    }

    /**
     * @covers  Molajo\Fieldhandler\HandleResponse::getFieldValue
     *
     * @return  void
     * @since   1.0.0
     */
    public function testGetFieldValue()
    {
        $original_data_value = 1;
        $response_value = 2;

        $this->handle_response = new HandleResponse($original_data_value,
            $response_value);

        $results = $this->handle_response->getFieldValue();

        $this->assertEquals($results, $response_value);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\HandleResponse::getChangeIndicator
     *
     * @return  void
     * @since   1.0.0
     */
    public function testGetChangeIndicator()
    {
        $original_data_value = 1;
        $response_value = 2;

        $this->handle_response = new HandleResponse($original_data_value,
            $response_value);

        $results = $this->handle_response->getChangeIndicator();

        $this->assertEquals($results, true);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\HandleResponse::getChangeIndicator
     * @covers  Molajo\Fieldhandler\HandleResponse::testNoValueChange
     *
     * @return  void
     * @since   1.0.0
     */
    public function testGetChangeIndicatortestNoValueChange()
    {
        $original_data_value = null;
        $response_value = false;

        $this->handle_response = new HandleResponse($original_data_value,
            $response_value);

        $results = $this->handle_response->getChangeIndicator();

        $this->assertEquals($results, true);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\HandleResponse::testNoValueChange
     * @return  void
     * @since   1.0.0
     */
    public function testTestNoValueChange()
    {
        $original_data_value = null;
        $response_value = false;

        $this->handle_response = new HandleResponse($original_data_value,
            $response_value);

        $results = $this->handle_response->getChangeIndicator();

        $this->assertEquals($results, true);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\HandleResponse::testNoValueChange
     * @return  void
     * @since   1.0.0
     */
    public function testTestNoValueChange2()
    {
        $original_data_value = false;
        $response_value = null;

        $this->handle_response = new HandleResponse($original_data_value,
            $response_value);

        $results = $this->handle_response->getChangeIndicator();

        $this->assertEquals($results, true);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\HandleResponse::testNoValueChange
     * @return  void
     * @since   1.0.0
     */
    public function testTestNoValueChange3()
    {
        $original_data_value = 0;
        $response_value = null;

        $this->handle_response = new HandleResponse($original_data_value,
            $response_value);

        $results = $this->handle_response->getChangeIndicator();

        $this->assertEquals($results, true);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\HandleResponse::testNoValueChange
     * @return  void
     * @since   1.0.0
     */
    public function testTestNoValueChange4()
    {
        $original_data_value = null;
        $response_value = null;

        $this->handle_response = new HandleResponse($original_data_value,
            $response_value);

        $results = $this->handle_response->getChangeIndicator();

        $this->assertEquals($results, false);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\HandleResponse::testNoValueChangeCompare
     * @return  void
     * @since   1.0.0
     */
    public function testTestNoValueChangeCompare()
    {
        $original_data_value = 1;
        $response_value = 1;

        $this->handle_response = new HandleResponse($original_data_value,
            $response_value);

        $results = $this->handle_response->getChangeIndicator();

        $this->assertEquals($results, false);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\HandleResponse::testNoValueChangeCompare
     * @return  void
     * @since   1.0.0
     */
    public function testTestNoValueChangeCompare2()
    {
        $original_data_value = null;
        $response_value = null;

        $this->handle_response = new HandleResponse($original_data_value,
            $response_value);

        $results = $this->handle_response->getChangeIndicator();

        $this->assertEquals($results, false);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\HandleResponse::testFloat
     * @return  void
     * @since   1.0.0
     */
    public function testTestFloat()
    {
        $original_data_value = 3.23345;
        $response_value = 3.21111111111113345;

        $this->handle_response = new HandleResponse($original_data_value,
            $response_value);

        $results = $this->handle_response->getChangeIndicator();

        $this->assertEquals($results, true);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\HandleResponse::testFloat
     * @return  void
     * @since   1.0.0
     */
    public function testTestFloat2()
    {
        $original_data_value = 3.000005;
        $response_value = 3.000005;

        $this->handle_response = new HandleResponse($original_data_value,
            $response_value);

        $results = $this->handle_response->getChangeIndicator();

        $this->assertEquals($results, false);

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
