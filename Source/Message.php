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
    protected $message_templates = array();

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
     * @return  string
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getMessageTemplate($code)
    {
        if (isset($this->message_templates[ $code ])) {
            return $this->message_templates[ $code ];
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

            $this->parameter_injected_tokens[ '{' . $token . '}' ] = $value;
        }

        return $this;
    }
}
