<?php
/**
 * ValidateResponse Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\ValidateResponse;
use PHPUnit_Framework_TestCase;

/**
 * ValidateResponse Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class ValidateResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * ValidateResponse
     *
     * @var    object  Molajo\Fieldhandler\ValidateResponse
     * @since  1.0.0
     */
    protected $validate_response;

    /**
     * Set up
     *
     * @return  void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $validate_response = false;
        $validate_messages = array('I am a message');

        $this->validate_response = new ValidateResponse($validate_response, $validate_messages);
    }

    /**
     * @covers  Molajo\Fieldhandler\ValidateResponse::getValidateResponse
     * @return  void
     * @since   1.0.0
     */
    public function testGetValidateResponse()
    {
        $results = $this->validate_response->getValidateResponse();

        $this->assertEquals(false, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\ValidateResponse::getValidateMessages
     * @return  void
     * @since   1.0.0
     */
    public function testGetValidateMessages()
    {
        $results = $this->validate_response->getValidateMessages();

        $this->assertEquals(array('I am a message'), $results);

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
