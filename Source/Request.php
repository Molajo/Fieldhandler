<?php
/**
 * Fieldhandler Request
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use Exception;
use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\HandleInputInterface;
use CommonApi\Model\HandleOutputInterface;
use CommonApi\Model\ValidateInterface;

/**
 * Fieldhandler Request
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
class Request implements ValidateInterface, HandleInputInterface, HandleOutputInterface
{
    /**
     * Constraint
     *
     * @var    string
     * @since  1.0.0
     */
    protected $constraint;

    /**
     * Constraint Instance
     *
     * @var    object  CommonApi\Model\ConstraintInterface
     * @since  1.0.0
     */
    protected $constraint_instance;

    /**
     * Method (validate, handleInput, handleOutput)
     *
     * @var    string
     * @since  1.0.0
     */
    protected $method;

    /**
     * Field Name
     *
     * @var    string
     * @since  1.0.0
     */
    protected $field_name;

    /**
     * Field Value
     *
     * @var    mixed
     * @since  1.0.0
     */
    protected $field_value;

    /**
     * Options
     *
     * @var    array
     * @since  1.0.0
     */
    protected $options = array();

    /**
     * Validate Response
     *
     * @var    boolean
     * @since  1.0.0
     */
    protected $validate_response;

    /**
     * Message Instance
     *
     * @var    object  CommonApi\Model\MessageInterface
     * @since  1.0.0
     */
    protected $message_instance;

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
     * Constructor
     *
     * @param   string $message_templates
     *
     * @since   1.0.0
     */
    public function __construct(
        array $message_templates = array()
    ) {
        if (count($message_templates) > 0) {
            $this->message_templates = $message_templates;
        }
    }

    /**
     * Validate Request
     *
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $constraint
     * @param   array      $options
     *
     * @return  \CommonApi\Model\ValidateResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate($field_name, $field_value = null, $constraint, array $options = array())
    {
        return $this->processRequest('validate', $field_name, $field_value, $constraint, $options);
    }

    /**
     * Handle Input Request
     *
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $constraint
     * @param   array      $options
     *
     * @return  \CommonApi\Model\HandleResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function handleInput($field_name, $field_value = null, $constraint, array $options = array())
    {
        return $this->processRequest('handleInput', $field_name, $field_value, $constraint, $options);
    }

    /**
     * Handle Output Request
     *
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $constraint
     * @param   array      $options
     *
     * @return  \CommonApi\Model\HandleResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function handleOutput($field_name, $field_value = null, $constraint, array $options = array())
    {
        return $this->processRequest('handleOutput', $field_name, $field_value, $constraint, $options);
    }

    /**
     * Process Request
     *
     * @param   string     $method
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $constraint
     * @param   array      $options
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function processRequest(
        $method,
        $field_name,
        $field_value = null,
        $constraint,
        array $options = array()
    ) {
        $this->setMethod($method);
        $this->setFieldName($field_name);
        $this->setFieldValue($field_value);
        $this->setOptions($options);
        $this->createConstraint($constraint);

        $response = $this->constraint_instance->$method();

        if ($method === 'validate') {
            $this->getValidateMessages();
            if ($response === false) {
                $this->validate_response = false;
            }
            return $this->setValidateResponse();
        }

        return $this->setHandleResponse($response);
    }

    /**
     * Get Validation Messages
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getValidateMessages()
    {
        if ($this->method === 'validate') {
        } else {
            return $this;
        }

        $messages = $this->constraint_instance->getValidateMessages();

        if (count($messages) > 0) {
            $tokens['field_name']  = $this->field_name;
            $tokens['field_value'] = $this->field_value;
            $tokens['constraint']  = $this->constraint;
            $tokens['method']      = $this->method;

            $this->message_instance->setMessages($messages, $tokens);
        }

        return $this;
    }

    /**
     * Set Method
     *
     * @param   string $method
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function setMethod($method)
    {
        $this->method = $method;

        if (in_array($this->method, array('validate', 'handleInput', 'handleOutput'))) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Request: Must provide validate, handleInput, or handleOutput as requested method.'
            );
        }

        $this->createMessageInstance();
        $this->validate_response = true;

        return $this;
    }

    /**
     * Set Field Name
     *
     * @param   string $field_name
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function setFieldName($field_name)
    {
        $this->field_name = ltrim(rtrim($field_name));

        if ($field_name === '' || $field_name === null) {
        } else {
            return $this;
        }

        throw new UnexpectedValueException
        (
            'Fieldhandler Request: Must provide the field name.'
        );
    }

    /**
     * Set Field Value
     *
     * @param   null|mixed $field_value
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function setFieldValue($field_value = null)
    {
        $this->field_value = $field_value;

        return $this;
    }

    /**
     * Set Options
     *
     * @param   array $options
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function setOptions(array $options = array())
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Set Constraint
     *
     * @param   string $constraint
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function createConstraint($constraint)
    {
        $this->constraint = ucfirst(strtolower($constraint));

        if (trim($this->constraint) === '' || $this->constraint === null) {

            throw new UnexpectedValueException
            (
                'Fieldhandler Request: Must request a specific constraint'
            );
        }

        $class = 'Molajo\\Fieldhandler\\Constraint\\' . $constraint;

        try {
            $this->constraint_instance = new $class (
                $this->constraint,
                $this->method,
                $this->field_name,
                $this->field_value,
                $this->options
            );

        } catch (Exception $e) {

            throw new UnexpectedValueException
            (
                'Fieldhandler Request createConstraint Method: Could not instantiate Constraint: ' . $constraint
                . ' Class: ' . $class
            );
        }

        return $this;
    }

    /**
     * Create Message Instance
     *
     * @return  \CommonApi\Model\HandleResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function createMessageInstance()
    {
        $class = 'Molajo\\Fieldhandler\\Message';

        try {
            $this->message_instance = new $class($this->message_templates);

        } catch (Exception $e) {

            throw new UnexpectedValueException
            (
                'Fieldhandler Request createMessageInstance Method: Cannot create class ' . $class
            );
        }
    }

    /**
     * Instantiates Validation Response
     *
     * @return  \CommonApi\Model\ValidateResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function setValidateResponse()
    {
        $class = 'Molajo\\Fieldhandler\\ValidateResponse';

        try {
            return new $class(
                $this->validate_response,
                $this->message_instance->getMessages()
            );

        } catch (Exception $e) {

            throw new UnexpectedValueException
            (
                'Fieldhandler Request setValidateResponse Method: Cannot create class ' . $class
            );
        }
    }

    /**
     * Create Handle Response
     *
     * @param   mixed $response
     *
     * @return  \CommonApi\Model\HandleResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function setHandleResponse($response)
    {
        $class = 'Molajo\\Fieldhandler\\HandleResponse';

        try {
            return new $class(
                $this->field_value,
                $response
            );

        } catch (Exception $e) {

            throw new UnexpectedValueException
            (
                'Fieldhandler Request setHandleResponse Method: Cannot create class ' . $class
            );
        }
    }
}
