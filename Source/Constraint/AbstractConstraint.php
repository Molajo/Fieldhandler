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
     * Ignore Null
     *
     * @api
     * @var    boolean
     * @since  1.0.0
     */
    protected $ignore_null = true;

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
    protected $selected_constraint_options = null;

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
    protected $property_array
        = array(
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
     * Validate
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        if ($this->field_value === null
            && $this->ignore_null === true
        ) {
            return true;
        }

        if ($this->validation() === true) {
            return true;
        }

        $this->setValidateMessage($this->message_code);

        return false;
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
        if ($this->field_value === null
            && $this->ignore_null === true
        ) {
            return $this->field_value;
        }

        $validated = $this->validation();

        if ($validated === true || is_array($this->field_value)) {
        } else {
            $this->field_value = null;
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
    public function setValidateMessage($message_code = null)
    {
        if ($message_code === null) {
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
    protected function validation()
    {
        return false;
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
            $options = $this->setPropertyKeyWithOptionKey($key, $options);
        }

        $this->options = $options;

        return $this;
    }

    /**
     * Set Property->$Key with Option[$Key]
     *
     * @param   string $key
     * @param   array  $options
     *
     * @return  array
     * @since   1.0.0
     */
    protected function setPropertyKeyWithOptionKey($key, array $options = array())
    {
        if (isset($options[ $key ])) {
            $this->$key = $options[ $key ];
            unset($options[ $key ]);
        }

        return $options;
    }

    /**
     * Get timezone
     *
     * @return  AbstractConstraint
     * @since   1.0.0
     */
    protected function getUserTimeZone()
    {
        $timezone = $this->timezone;

        if ($timezone === '') {
            if (ini_get('date.timezone')) {
                $timezone = ini_get('date.timezone');
            }
        }

        if ($timezone === '') {
            $timezone = 'UTC';
        }

        $this->timezone = $timezone;

        return $this;
    }
}
