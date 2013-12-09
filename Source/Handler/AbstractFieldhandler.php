<?php
/**
 * Abstract Fieldhandler Class
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Handler;

use CommonApi\Exception\UnexpectedValueException;

/**
 * Abstract Fieldhandler Class
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
abstract class AbstractFieldhandler
{
    /**
     * Fieldhandler Type
     *
     * @var    mixed
     * @since  1.0
     */
    protected $fieldhandler_type;

    /**
     * Method (validate, filter, escape)
     *
     * @var    string
     * @since  1.0
     */
    protected $method;

    /**
     * Field Name
     *
     * @var    string
     * @since  1.0
     */
    protected $field_name;

    /**
     * Data Value
     *
     * @var    mixed
     * @since  1.0
     */
    protected $field_value;

    /**
     * Options
     *
     * @var    array
     * @since  1.0
     */
    protected $options;

    /**
     * Database instance
     *
     * @var    object
     * @since  1.0
     */
    protected $database;

    /**
     * Database Table
     *
     * @var    object
     * @since  1.0
     */
    protected $table;

    /**
     * Table key
     *
     * @var    object
     * @since  1.0
     */
    protected $key;

    /**
     * Timezone
     *
     * @var    string
     * @since  1.0
     */
    protected $timezone;

    /**
     * HTML Entities
     *
     * @var    array
     * @since  1.0
     */
    protected $html_entities = array(
        34 => 'quot',
        38 => 'amp',
        60 => 'lt',
        62 => 'gt',
    );

    /**
     * Encoding
     *
     * @var    string
     * @since  1.0
     */
    protected $encoding = 'utf-8';

    /**
     * Constructor
     *
     * @param   string $fieldhandler_type
     * @param   string $method
     * @param   string $field_name
     * @param   mixed  $field_value
     * @param   array  $options
     *
     * @since   1.0
     */
    public function __construct(
        $fieldhandler_type,
        $method,
        $field_name,
        $field_value,
        $options
    ) {
        if (function_exists('date_default_timezone_set') && function_exists('date_default_timezone_get')) {
            date_default_timezone_set(@date_default_timezone_get());
        }

        $this->setFieldhandlerType($fieldhandler_type);
        $this->setMethod($method);
        $this->setFieldName($field_name);
        $this->setFieldValue($field_value);
        $this->setOptions($options);
        $this->setDatabase();
        $this->setTable();
        $this->setKey();
        $this->getUserTimeZone();

        return $this;
    }

    /**
     * Validate
     *
     * @return  mixed
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        return $this->getFieldValue();
    }

    /**
     * Filter
     *
     * @return  mixed
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function filter()
    {
        return $this->getFieldValue();
    }

    /**
     * Escape
     *
     * @return  mixed
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function escape()
    {
        return $this->getFieldValue();
    }

    /**
     * Set the Method
     *
     * @param   string $method
     *
     * @return  $this
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function setMethod($method)
    {
        $method = strtolower($method);

        if ($method == 'validate'
            || $method == 'filter'
            || $method == 'escape'
        ) {
        } else {
            throw new UnexpectedValueException
            ('Fieldhandler: Invalid Method: ' . $method
            . ' Must be  validate, filter, escape.');
        }

        $this->method = $method;

        return $this;
    }

    /**
     * Get the Path
     *
     * @return  string
     * @since   1.0
     */
    protected function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the Fieldhandler Type
     *
     * @param   string $fieldhandler_type
     *
     * @return  string
     * @since   1.0
     */
    protected function setFieldhandlerType($fieldhandler_type)
    {
        $this->fieldhandler_type = $fieldhandler_type;

        return $this;
    }

    /**
     * Get the Fieldhandler Type
     *
     * @return  string
     * @since   1.0
     */
    protected function getFieldhandlerType()
    {
        return $this->fieldhandler_type;
    }

    /**
     * Set the Field Name
     *
     * @param   string $field_name
     *
     * @return  $this
     * @since   1.0
     */
    protected function setFieldName($field_name)
    {
        $this->field_name = $field_name;

        return $this;
    }

    /**
     * Set the Value
     *
     * @param   string $field_value
     *
     * @return  $this
     * @since   1.0
     */
    public function setFieldValue($field_value)
    {
        $this->field_value = $field_value;

        return $this;
    }

    /**
     * Get Value
     *
     * @return  mixed
     * @since   1.0
     */
    public function getFieldValue()
    {
        return $this->field_value;
    }

    /**
     * Set Options
     *
     * @param   string $options
     *
     * @return  $this
     * @since   1.0
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get Options
     *
     * @return  array
     * @since   1.0
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set Database
     *
     * @return  $this
     * @since   1.0
     */
    public function setDatabase()
    {
        if (isset($this->options['database'])) {
            $this->database = $this->options['database'];
        } else {
            $this->database = null;
        }

        return $this;
    }

    /**
     * Get Database
     *
     * @return  array
     * @since   1.0
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * Set Table
     *
     * @return  $this
     * @since   1.0
     */
    public function setTable()
    {
        if (isset($this->options['table'])) {
            $this->table = $this->options['table'];
        } else {
            $this->table = null;
        }

        return $this;
    }

    /**
     * Get Table
     *
     * @return  array
     * @since   1.0
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set Key
     *
     * @return  $this
     * @since   1.0
     */
    public function setKey()
    {
        if (isset($this->options['key'])) {
            $this->key = $this->options['key'];
        } else {
            $this->key = null;
        }

        return $this;
    }

    /**
     * Get Key
     *
     * @return  array
     * @since   1.0
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get timezone
     *
     * @return  array
     * @since   1.0
     */
    protected function getUserTimeZone()
    {
        $timezone = '';

        if (is_array($this->options)) {
        } else {
            return $this;
        }

        if (isset($this->options['timezone'])) {
            $timezone = $this->options['timezone'];
        }

        if ($timezone === '') {
            if (ini_get('date.timezone')) {
                $timezone = ini_get('date.timezone');
            }
        }

        if ($timezone === '') {
            $timezone = 'UTC';
        }

        ini_set('date.timezone', $timezone);
        $this->options['timezone'] = $timezone;

        $this->setTimezone($timezone);

        return $this;
    }

    /**
     * Set the Timezone
     *
     * @param   string $timezone
     *
     * @return  string
     * @since   1.0
     */
    protected function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get the Timezone
     *
     * @return  string
     * @since   1.0
     */
    protected function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Test the string specified in $filter using the function defined by $test
     *
     * @param   string $test
     * @param   string $filter
     *
     * @return  string
     * @since   1.0
     */
    public function filterByCharacter($test, $filter)
    {
        $filtered = '';

        if (strlen($filter) > 0) {
            for ($i = 0; $i < strlen($filter); $i ++) {
                if ($test(substr($filter, $i, 1)) == 1) {
                    $filtered .= substr($filter, $i, 1);
                }
            }
        }

        return $filtered;
    }

    /**
     * Get the 'true' array
     *
     * @return  array
     * @since   1.0
     */
    public function getTrueArray()
    {
        $trueArray   = array();
        $trueArray[] = true;
        $trueArray[] = 1;
        $trueArray[] = 'yes';
        $trueArray[] = 'on';

        return $trueArray;
    }

    /**
     * Get the test input value
     *
     * @return  mixed
     * @since   1.0
     */
    public function getTestValue()
    {
        $testValue = $this->getFieldValue();
        if (is_numeric($testValue) || is_bool($testValue)) {
        } else {
            $testValue = strtolower($testValue);
        }

        return $testValue;
    }
}
