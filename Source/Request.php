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
use CommonApi\Model\FormatInterface;
use CommonApi\Model\SanitizeInterface;
use CommonApi\Model\ValidateInterface;

/**
 * The Fieldhandler Request Class is the only entry point for application access, acting as a
 *  proxy for `validate`, `sanitize`, and `format` constraints requests.
 *
 * @code
 *
 * The $request object can be used repeatedly for any `validate`, `sanitize`, and `format` requests.
 *
 * ```php
 *
 * $request = new \Molajo\Fieldhandler\Request();
 *
 * ```
 * There are three methods:
 *
 * * validate - evaluates data given constraint criteria returning true or false result and error messages
 * * filter - cleans field value not in compliance with constraint, returning new value and indicator of change
 * * format - processes field according to constraint requirements, returning new value and indicator of change
 *
 * Each method  `validate`, `sanitize`, and `format` use these four parameters:
 *
 * * $field_name - a value to be used in error messages as the name of the field
 * * $field_value - data value to be validated, filtered, or escaped
 * * $constraint - the name of the constraint to be used by this request
 * * $options - associative array of key values pairs; requirements defined by constraint class
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @api
 */
class Request implements ValidateInterface, SanitizeInterface, FormatInterface
{
    /**
     * Method: validate, sanitize, format
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $method;

    /**
     * Field Name: value to be used in error messages as the name of the field
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $field_name;

    /**
     * Field Value: data value to be validated, filtered, or escaped
     *
     * @api
     * @var    mixed
     * @since  1.0.0
     */
    protected $field_value;

    /**
     * Constraint: the name of the constraint to be used by this request
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $constraint;

    /**
     * Options: associative array of key values pairs; requirements defined by constraint class
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $options = array();

    /**
     * Constraint Instance
     *
     * @var    object  CommonApi\Model\ConstraintInterface
     * @since  1.0.0
     */
    protected $constraint_instance;

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
     * @api
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
    }

    /**
     * Validate Request - validates $field_value for compliance with constraint specifications
     *
     * @param   string     $field_name  Defines a textual value used in messages
     * @param   null|mixed $field_value Value of the field to be processed
     * @param   string     $constraint  Name of the data constraint to evaluate $field_value
     * @param   array      $options     Options vary by and are documented in the constraint class
     *
     * @code
     *
     * Validate evaluates the $field_value for the specified $constraint, given any $options
     *  the $constraint requires, and determines if the data is compliant.
     *
     * The response object contains the results of the validation request and an array of
     *  error messages if issues were found.
     *
     * ```php
     *
     * $response = $request->validate($field_name, $field_value, $constraint, $options);
     *
     * if ($response->getValidateResponse() === true) {
     *     // all is well
     * } else {
     *      foreach ($response->getValidateMessages as $code => $message) {
     *          echo $code . ': ' . $message . '/n';
     *      }
     * }
     *
     * ```
     * @api
     * @return  \CommonApi\Model\ValidateResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate($field_name, $field_value = NULL, $constraint, array $options = array())
    {
        return $this->processRequest('validate', $field_name, $field_value, $constraint, $options);
    }

    /**
     * Sanitize Request - sanitizes $field_value, if necessary, in accordance with constraint specifications
     *
     * @param   string     $field_name  Defines a textual value used in messages
     * @param   null|mixed $field_value Value of the field to be processed
     * @param   string     $constraint  Name of the data constraint to evaluate $field_value
     * @param   array      $options     Options vary by and are documented in the constraint class
     *
     * @code
     *
     * Sanitize cleans the $field_value for the specified $constraint, given any $options
     *  the $constraint requires
     *
     * The response object contains the data value following the process and a change indicator
     *
     * ```php
     *
     * $response = $request->sanitize($field_name, $field_value, $constraint, $options);
     *
     * // Replace the existing value if it was changed by filtering
     *
     * if ($response->getChangeIndicator() === true) {
     *     $field_value = $response->getFieldValue();
     * }
     *
     * ```
     * @api
     * @return  \CommonApi\Model\HandleResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function sanitize($field_name, $field_value = NULL, $constraint, array $options = array())
    {
        return $this->processRequest('sanitize', $field_name, $field_value, $constraint, $options);
    }

    /**
     * Format Request - formatting or special treatment defined within constraint specifications
     *
     * $response = $request->format($field_name, $field_value, $constraint, $options);
     *
     * @param   string     $field_name  Defines a textual value used in messages
     * @param   null|mixed $field_value Value of the field to be processed
     * @param   string     $constraint  Name of the data constraint to evaluate $field_value
     * @param   array      $options     Options vary by and are documented in the constraint class
     *
     * @code
     *
     * Format processes the $field_value for the specified $constraint, given any $options
     *  the $constraint requires. Example of formatting could include email obfuscation or
     *  formatting a phone number for display.
     *
     * The response object contains the data value following the process and a change indicator
     *
     * ```php
     *
     * $response = $request->format($field_name, $field_value, $constraint, $options);
     *
     * // Replace the existing value if it was changed by the request
     *
     * if ($response->getChangeIndicator() === true) {
     *     $field_value = $response->getFieldValue();
     * }
     *
     * ```
     * @api
     * @return  \CommonApi\Model\HandleResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function format($field_name, $field_value = NULL, $constraint, array $options = array())
    {
        return $this->processRequest('format', $field_name, $field_value, $constraint, $options);
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
        $field_value = NULL,
        $constraint,
        array $options = array()
    ) {
        $this->setMethod($method);
        $this->setFieldName($field_name);
        $this->setFieldValue($field_value);
        $this->setOptions($options);
        $this->createConstraint($constraint);

        return $this->runConstraintMethod($method);
    }

    /**
     * Run Constraint Method
     *
     * @param   string $method
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function runConstraintMethod($method)
    {
        $response = $this->constraint_instance->$method();

        if ($method === 'validate') {
            $this->getValidateMessages();
            if ($response === FALSE) {
                $this->validate_response = FALSE;
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
        $messages = $this->constraint_instance->getValidateMessages();

        if (count($messages) === 0) {
        } else {
            return $this;
        }

        $tokens = array();

        $tokens['field_name']  = $this->field_name;
        $tokens['field_value'] = $this->field_value;
        $tokens['constraint']  = $this->constraint;
        $tokens['method']      = $this->method;

        return $this->message_instance->setMessages($messages, $tokens);
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

        if (in_array($this->method, array('validate', 'sanitize', 'format'))) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Request: Must provide validate, sanitize, or format as requested method.'
            );
        }

        $this->createMessageInstance();

        $this->validate_response = TRUE;

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

        if ($field_name === '' || $field_name === NULL) {
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
    protected function setFieldValue($field_value = NULL)
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
     */
    protected function createConstraint($constraint)
    {
        $this->editConstraint($constraint);

        $this->constraint_instance = $this->createConstraintClass($constraint);

        return $this;
    }

    /**
     * Edit Constraint
     *
     * @param   string $constraint
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function editConstraint($constraint)
    {
        $this->constraint = ucfirst(strtolower($constraint));

        if (trim($this->constraint) === '' || $this->constraint === NULL) {

            throw new UnexpectedValueException
            (
                'Fieldhandler Request: Must request a specific constraint'
            );
        }

        return $this;
    }

    /**
     * Create Constraint Class
     *
     * @param   string $constraint
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function createConstraintClass($constraint)
    {
        $class = 'Molajo\\Fieldhandler\\Constraint\\' . $constraint;

        try {
            return new $class ($this->constraint, $this->method, $this->field_name, $this->field_value, $this->options);

        } catch (Exception $e) {

            throw new UnexpectedValueException
            (
                'Fieldhandler Request createConstraint Method: Failed: ' . $constraint . ' Class: ' . $class
            );
        }
    }

    /**
     * Create Message Instance
     *
     * @return  $this
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

        return $this;
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
