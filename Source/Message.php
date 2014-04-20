<?php
/**
 * Message Class
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\MessageInterface;
use stdClass;

/**
 * Message Class
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Message implements MessageInterface
{
    /**
     * Message Templates
     *
     * @var    array
     * @since  1.0.0
     */
    protected $message_templates = array(
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
        14000 => 'Field: {field_name} value does not match a value from the list allowed.',
    );

    /**
     * Parameter injected tokens
     *
     * @var    array
     * @since  1.0.0
     */
    protected $parameter_injected_tokens = array();

    /**
     * Messages
     *
     * @var    array
     * @since  1.0.0
     */
    protected $messages = array();

    /**
     * Constructor
     *
     * @param   array $message_templates
     *
     * @since   1.0.0
     */
    public function __construct(
        array $message_templates = array()
    ) {
        if (count($message_templates) > 0) {
            $this->message_templates = $message_templates;
        }

        $this->messages                  = array();
        $this->parameter_injected_tokens = array();
    }

    /**
     * Get Messages
     *
     * @return  array
     * @since   1.0.0
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set Messages and inject tokens
     *
     * @param   array $message_codes
     * @param   array $tokens
     *
     * @return  $this
     * @since   1.0.0
     */
    public function setMessages(array $message_codes, array $tokens)
    {
        $this->setMessageTokens($tokens);

        foreach ($message_codes as $code) {
            $template = $this->getMessageTemplate($code);

            $message          = new stdClass();
            $message->code    = $code;
            $message->message = strtr($template, $this->parameter_injected_tokens);

            $this->messages[] = $message;
        }

        return $this;
    }

    /**
     * Get Message Template
     *
     * @param   string $code
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getMessageTemplate($code)
    {
        if (isset($this->message_templates[$code])) {
            return $this->message_templates[$code];
        }

        throw new UnexpectedValueException
        (
            'Fieldhandler Message getMessageTemplate Method: Do not have template: ' . $code
        );
    }

    /**
     * Replace tokens in error messages
     *
     * @param   array $tokens
     *
     * @return  $this
     * @since   1.0.0
     */
    protected function setMessageTokens(array $tokens)
    {
        $this->parameter_injected_tokens = array();

        foreach ($tokens as $token => $value) {

            if (is_array($value)) {
                $value = implode(',', $value);

            } elseif (is_object($value)) {
                $value = 'object';
            }

            $value = (string)$value;

            $this->parameter_injected_tokens['{' . $token . '}'] = $value;
        }

        return $this;
    }
}
