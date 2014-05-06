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
        array $options = array())
    {
        if (function_exists('date_default_timezone_set') && function_exists('date_default_timezone_get')) {
            date_default_timezone_set(@date_default_timezone_get());
        }

        $this->constraint  = $constraint;
        $this->method      = $method;
        $this->field_name  = $field_name;
        $this->field_value = $field_value;

        foreach ($this->property_array as $key) {
            $options = $this->setPropertyKeyWithOptionKey($options, $key);
        }

        $this->options = $options;

        $this->getUserTimeZone();
    }

    /**
     * Used by Constraint Classes to customize option values needed for Field handling
     *
     * @return  AbstractConstraint
     * @since   1.0.0
     */
    public function setOptions()
    {
        return $this;
    }

    /**
     * Validate
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    abstract public function validate();

    /**
     * Sanitize
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function sanitize()
    {
        if ($this->field_value === null) {
            return $this->field_value;
        }

        if ($this->validate() === false) {
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
     * @param   string $message_code
     *
     * @api
     * @return  $this
     * @since   1.0.0
     */
    public function setValidateMessage($message_code)
    {
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
     * Set Property->$Key with Option[$Key]
     *
     * @param   string  $key
     * @param   array   $options
     *
     * @return  array
     * @since   1.0.0
     */
    protected function setPropertyKeyWithOptionKey(array $options = array(), $key)
    {
        if (isset($options[$key])) {
            $this->$key = $options[$key];
            unset($options[$key]);
        }

        return $options;
    }

    /**
     * Get $option $key value, if available, or use $default value
     *
     * @param   string      $key
     * @param   null|mixed  $default
     *
     * @return  mixed
     * @since   1.0.0
     */
    protected function getOption($key, $default = null)
    {
        if (isset($this->options[$key])) {
        } else {
            if ($default === null) {
                return null;
            }
            $this->options[$key] = $default;
        }

        return $this->options[$key];
    }

    /**
     * Flags can be set in options array
     *
     * @return  string|null
     * @since   1.0.0
     */
    protected function setFlags()
    {
        $this->selected_constraint_options = null;

        if (is_array($this->constraint_allowable_options)
            && count($this->constraint_allowable_options) > 0
        ) {

            foreach ($this->constraint_allowable_options as $option) {

                $have_it = $this->getOption($option);

                if ($have_it === null) {
                } else {

                    if ($this->selected_constraint_options === null) {
                    } else {
                        $this->selected_constraint_options .= ', ';
                    }

                    $this->selected_constraint_options .= $option;
                }
            }

        }

        return $this->selected_constraint_options;
    }

    /**
     * Test the string specified in $filter using the function defined by $test
     *
     * @param   string $filter
     * @param   string $test
     * @param   string $allow_whitespace
     *
     * @return  string
     * @since   1.0.0
     */
    protected function sanitizeByCharacter($filter, $test, $allow_whitespace = false)
    {
        $filtered = '';

        if (strlen($test) > 0) {
            for ($i = 0; $i < strlen($test); $i ++) {
                if (($filter(substr($test, $i, 1)) == 1)
                    || ($allow_whitespace === true && substr($test, $i, 1) === ' ')
                ) {
                    $filtered .= substr($test, $i, 1);
                }
            }
        }

        return $filtered;
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
