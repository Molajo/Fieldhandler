<?php
/**
 * Message Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use CommonApi\Exception\UnexpectedValueException;
use Molajo\Fieldhandler\Message;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * Message Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class MessageTest extends PHPUnit_Framework_TestCase
{
    /**
     * Message
     *
     * @var    object  Molajo\Fieldhandler\Message
     * @since  1.0.0
     */
    protected $message;

    /**
     * Set up
     *
     * @return  void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $message_templates = array(
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

        $this->message = new Message($message_templates);
    }

    /**
     * @covers  Molajo\Fieldhandler\Message::setMessages
     * @return  void
     * @since   1.0.0
     */
    public function testSetMessages()
    {
        $message_codes = array(1000);

        $tokens = array();

        $tokens['field_name']  = 'Field Name';
        $tokens['field_value'] = 'abc';
        $tokens['constraint']  = 'Numeric';
        $tokens['method']      = 'sanitize';

        $results = $this->message->setMessages($message_codes, $tokens);

        $this->assertTrue(is_object($results));

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Message::getMessages
     * @return  void
     * @since   1.0.0
     */
    public function testGetMessages()
    {
        $message_codes = array(1000);

        $tokens = array();

        $tokens['field_name']  = 'Field Name';
        $tokens['field_value'] = 'abc';
        $tokens['constraint']  = 'Numeric';
        $tokens['method']      = 'sanitize';

        $this->message->setMessages($message_codes, $tokens);

        $results = $this->message->getMessages();

        $message          = new stdClass();
        $message->code    = '1000';
        $message->message = 'Field: Field Name does not have a valid value for Numeric data type.';

        $this->assertEquals($results, array($message));

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Message::getMessageTemplate
     * @return  void
     * @since   1.0.0
     */
    public function testGetMessageTemplate()
    {
        $message_codes = array(4000);

        $tokens = array();

        $tokens['field_name']  = 'Field Name';
        $tokens['field_value'] = 'abc';
        $tokens['constraint']  = 'Numeric';
        $tokens['method']      = 'sanitize';

        $this->message->setMessages($message_codes, $tokens);

        $results = $this->message->getMessages();

        $message          = new stdClass();
        $message->code    = '4000';
        $message->message = 'Field: Field Name has an invalid array element value.';

        $this->assertEquals($results, array($message));

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Message::getMessageTemplate
     * @expectedException        \CommonApi\Exception\UnexpectedValueException
     * @expectedExceptionMessage Fieldhandler Message getMessageTemplate Method: Do not have template: 4444
     *
     * @since   1.0.0
     */
    public function testGetMessageTemplateException()
    {
        $message_codes = array(4444);

        $tokens = array();

        $tokens['field_name']  = 'Field Name';
        $tokens['field_value'] = 'abc';
        $tokens['constraint']  = 'Numeric';
        $tokens['method']      = 'sanitize';

        $this->message->setMessages($message_codes, $tokens);

        $results = $this->message->getMessages();

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Message::setMessageTokens
     * @return  void
     * @since   1.0.0
     */
    public function testSetMessageTokens()
    {
        $message_codes = array(14000);

        $tokens = array();

        $tokens['field_name']  = 'Field Name';
        $tokens['field_value'] = 'abc';
        $tokens['constraint']  = 'Numeric';
        $tokens['method']      = 'sanitize';

        $this->message->setMessages($message_codes, $tokens);

        $results = $this->message->getMessages();

        $message          = new stdClass();
        $message->code    = '14000';
        $message->message = 'Field: Field Name value abc does not match a value from the list allowed.';

        $this->assertEquals($results, array($message));

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Message::setMessageTokens
     * @return  void
     * @since   1.0.0
     */
    public function testSetMessageTokens2()
    {
        $array       = array();
        $array[]     = 'entry1';
        $array[]     = 'entry2';

        $message_codes = array(14000);

        $tokens = array();

        $tokens['field_name']  = 'Field Name';
        $tokens['field_value'] = $array;
        $tokens['constraint']  = 'Numeric';
        $tokens['method']      = 'sanitize';

        $this->message->setMessages($message_codes, $tokens);

        $results = $this->message->getMessages();

        $message          = new stdClass();
        $message->code    = '14000';
        $message->message = 'Field: Field Name value entry1,entry2 does not match a value from the list allowed.';

        $this->assertEquals($results, array($message));

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Message::setMessageTokens
     * @return  void
     * @since   1.0.0
     */
    public function testSetMessageTokens3()
    {
        $object       = new stdClass();
        $object->code = '14000';
        $object->name = 'xyz';

        $message_codes = array(14000);

        $tokens = array();

        $tokens['field_name']  = 'Field Name';
        $tokens['field_value'] = $object;
        $tokens['constraint']  = 'Numeric';
        $tokens['method']      = 'sanitize';

        $this->message->setMessages($message_codes, $tokens);

        $results = $this->message->getMessages();

        $message          = new stdClass();
        $message->code    = '14000';
        $message->message = 'Field: Field Name value object does not match a value from the list allowed.';

        $this->assertEquals($results, array($message));

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
