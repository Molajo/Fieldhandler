<?php
/**
 * Abstract Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Abstract Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractConstraint implements ConstraintInterface
{
    /**
     * Constraint
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $constraint;

    /**
     * Method (validate, sanitize, format)
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $method;

    /**
     * Field Name
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $field_name;

    /**
     * Field Value
     *
     * @api
     * @var    mixed
     * @since  1.0.0
     */
    protected $field_value;

    /**
     * Options
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $options = array();

    /**
     * Available Options defined within properties by Constraint
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $constraint_allowable_options = array();

    /**
     * Requested Options for Constraint
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $selected_constraint_options = NULL;

    /**
     * Timezone
     *
     * @var    string
     * @since  1.0.0
     */
    protected $timezone;

    /**
     * Properties
     *
     * @var    object
     * @since  1.0.0
     */
    protected $property_array = array(
        'timezone'
    );

    /**
     * Validation Messages
     *
     * @var    array
     * @since  1.0.0
     */
    protected $validate_messages = array();

    /**
     * Filter instance
     *
     * @var    object
     * @since  1.0.0
     */
    protected $filter_instance;

    /**
     * Method Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $method_test = 'validate';

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code;

    /**
     * Constructor
     *
     * @param   string $constraint
     * @param   string $method
     * @param   string $field_name
     * @param   mixed  $field_value
     * @param   array  $options
     *
     * @since   1.0.0
     */
    public function __construct(
        $constraint,
        $method,
        $field_name,
        $field_value,
        array $options = array()
    ) {
        if (function_exists('date_default_timezone_set') && function_exists('date_default_timezone_get')) {
            date_default_timezone_set(@date_default_timezone_get());
        }

        $this->constraint  = $constraint;
        $this->method      = $method;
        $this->field_name  = $field_name;
        $this->field_value = $field_value;

        $this->processOptions($options);

        $this->getUserTimeZone();
    }

    /**
     * Process Options
     *
     * @param   array $options
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function processOptions($options)
    {
        foreach ($this->property_array as $key) {
            $options = $this->setPropertyKeyWithOptionKey($options, $key);
        }

        $this->options = $options;

        return $this;
    }

    /**
     * Used by Constraint Classes to customize option values needed for Field handling
     *
     * @return  AbstractConstraint
     * @since   1.0.0
     */
    abstract public function setOptions();

    /**
     * Validate
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        if ($this->field_value === NULL) {
            return TRUE;
        }

        if ($this->validation() === TRUE) {
            return TRUE;
        }

        $this->setValidateMessage($this->message_code);

        return FALSE;
    }

    /**
     * Validation testing in sub-types
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function validation()
    {
        return FALSE;
    }

    /**
     * Default Sanitize - sanitize primarily in sub-types
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function sanitize()
    {
        if ($this->field_value === NULL) {
            return $this->field_value;
        }

        if ($this->$this->method_test() === TRUE) {
        } else {
            $this->field_value = NULL;
        }

        return $this->field_value;
    }

    /**
     * Format
     *
     * Unused format for constraint simply returns the field value
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function format()
    {
        return $this->field_value;
    }

    /**
     * Save Code for Validate Message
     *
     * @param   null|string $message_code
     *
     * @api
     * @return  $this
     * @since   1.0.0
     */
    public function setValidateMessage($message_code = NULL)
    {
        if ($message_code === NULL) {
            $message_code = 1000;
        }

        $this->validate_messages[] = $message_code;

        return $this;
    }

    /**
     * Get Validate Messages
     *
     * @api
     * @return  array
     * @since   1.0.0
     */
    public function getValidateMessages()
    {
        return $this->validate_messages;
    }
}
