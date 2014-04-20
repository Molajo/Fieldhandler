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
use CommonApi\Model\EscapeInterface;
use CommonApi\Model\FilterInterface;
use CommonApi\Model\ValidateInterface;

/**
 * Fieldhandler Request
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
class Request implements EscapeInterface, FilterInterface, ValidateInterface
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
     * Method (validate, filter, escape)
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
     * Validation Response
     *
     * @var    boolean
     * @since  1.0.0
     */
    protected $validation_response;

    /**
     * Message Instance
     *
     * @var    object  CommonApi\Model\MessageInterface
     * @since  1.0.0
     */
    protected $message_instance;

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
     * Escape Request
     *
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $constraint
     * @param   array      $options
     *
     * @return  \CommonApi\Model\EscapeResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function escape($field_name, $field_value = null, $constraint, array $options = array())
    {
        return $this->processRequest('escape', $field_name, $field_value, $constraint, $options);
    }

    /**
     * Filter Request
     *
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $constraint
     * @param   array      $options
     *
     * @return  \CommonApi\Model\FilterResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function filter($field_name, $field_value = null, $constraint, array $options = array())
    {
        return $this->processRequest('filter', $field_name, $field_value, $constraint, $options);
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
            $this->getValidationMessages();
            if ($response === false) {
                $this->validation_response = false;
            }
        } else {
            $this->field_value = $response;
        }

        if ($constraint === 'escape') {
            return $this->setEscapeResponse($response);

        } elseif ($constraint === 'filter') {
            return $this->setFilterResponse($response);
        }

        return $this->setValidationResponse();
    }

    /**
     * Get Validation Messages
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getValidationMessages()
    {
        if ($this->method === 'validate') {
        } else {
            return $this;
        }

        $messages = $this->constraint_instance->getErrorMessages();

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
        $this->method = strtolower($method);

        if (in_array($this->method, array('escape', 'filter', 'validate'))) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Request: Must provide either escape, filter, or validate as the requested method.'
            );
        }

        $this->createMessageInstance();

        $this->validation_response = true;

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
     * @return  \CommonApi\Model\EscapeResponseInterface
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
     * Create Escape Response
     *
     * @param   mixed $response
     *
     * @return  \CommonApi\Model\EscapeResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function setEscapeResponse($response)
    {
        $class = 'Molajo\\Fieldhandler\\EscapeResponse';

        try {
            return new $class($response);

        } catch (Exception $e) {

            throw new UnexpectedValueException
            (
                'Fieldhandler Request setEscapeResponse Method: Cannot create class ' . $class
            );
        }
    }

    /**
     * Create Filter Response
     *
     * @param   mixed $response
     *
     * @return  \CommonApi\Model\FilterResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function setFilterResponse($response)
    {
        $class = 'Molajo\\Fieldhandler\\FilterResponse';

        try {
            return new $class($response);

        } catch (Exception $e) {

            throw new UnexpectedValueException
            (
                'Fieldhandler Request setFilterResponse Method: Cannot create class ' . $class
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
    protected function setValidationResponse()
    {
        $class = 'Molajo\\Fieldhandler\\ValidationResponse';

        try {
            return new $class(
                $this->validation_response,
                $this->message_instance->getMessages()
            );

        } catch (Exception $e) {

            throw new UnexpectedValueException
            (
                'Fieldhandler Request setValidationResponse Method: Cannot create class ' . $class
            );
        }
    }
}
