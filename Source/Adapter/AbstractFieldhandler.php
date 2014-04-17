<?php
/**
 * Abstract Fieldhandler Class
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Abstract Fieldhandler Class
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractFieldhandler implements FieldhandlerAdapterInterface
{
    /**
     * Fieldhandler Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $fieldhandler_type;

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
     * Data Value
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
     * Database instance
     *
     * @var    object
     * @since  1.0.0
     */
    protected $database;

    /**
     * Database Table
     *
     * @var    string
     * @since  1.0.0
     */
    protected $table;

    /**
     * Table key
     *
     * @var    string
     * @since  1.0.0
     */
    protected $key;

    /**
     * Timezone
     *
     * @var    string
     * @since  1.0.0
     */
    protected $timezone;

    /**
     * HTML Entities
     *
     * @var    array
     * @since  1.0.0
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
     * @since  1.0.0
     */
    protected $encoding = 'utf-8';

    /**
     * White list
     *
     * @var    array
     * @since  1.0.0
     */
    protected $white_list = array(
        'a'          => array(
            'href'  => array('minlen' => 3, 'maxlen' => 50),
            'title' => array('valueless' => 'n')
        ),
        'address'    => array(),
        'article'    => array(),
        'aside'      => array(),
        'b'          => array(),
        'blockquote' => array(),
        'body'       => array(),
        'br'         => array(),
        'colgroup'   => array(),
        'dd'         => array(),
        'datagrid'   => array(),
        'dialog'     => array(),
        'dir'        => array(),
        'div'        => array(),
        'd1'         => array(),
        'fieldset'   => array(),
        'footer'     => array(),
        'font'       => array(
            'size' =>
                array('minval' => 4, 'maxval' => 20)
        ),
        'form'       => array(),
        'h1'         => array(),
        'h2'         => array(),
        'h3'         => array(),
        'h4'         => array(),
        'h5'         => array(),
        'h6'         => array(),
        'head'       => array(),
        'header'     => array(),
        'hr'         => array(),
        'html'       => array(),
        'i'          => array(),
        'img'        => array('src' => 1),
        'menu'       => array(),
        'nav'        => array(),
        'option'     => array(),
        'optgroup'   => array(),
        'ol'         => array(),
        'p'          => array(
            'align' => 1,
            'dummy' => array('valueless' => 'y')
        ),
        'pre'        => array(),
        'section'    => array(),
        'table'      => array(),
        'td'         => array(),
        'th'         => array(),
        'thead'      => array(),
        'tbody'      => array(),
        'tfoot'      => array(),
        'tr'         => array(),
        'ul'         => array()
    );

    /**
     * Errors
     *
     * @var    array
     * @since  1.0.0
     */
    protected $errors = array();

    /**
     * Constructor
     *
     * @param   string $fieldhandler_type
     * @param   string $method
     * @param   string $field_name
     * @param   mixed  $field_value
     * @param   array  $options
     *
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
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

        if (isset($options['white_list'])) {
            $this->white_list = $options['white_list'];
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
    }

    /**
     * Validate
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    abstract public function validate();

    /**
     * Filter
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    abstract public function filter();

    /**
     * Escape
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    abstract public function escape();

    /**
     * Set the Method
     *
     * @param   string $method
     *
     * @return  $this
     * @since   1.0.0
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
            (
                'Fieldhandler: Invalid Method: ' . $method . ' Must be  validate, filter, or escape.'
            );
        }

        $this->method = $method;

        return $this;
    }

    /**
     * Get the Path
     *
     * @return  string
     * @since   1.0.0
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
     * @since   1.0.0
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
     * @since   1.0.0
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
     * @since   1.0.0
     */
    protected function setFieldName($field_name)
    {
        $this->field_name = $field_name;

        return $this;
    }

    /**
     * Set the Value
     *
     * @param   mixed $field_value
     *
     * @return  $this
     * @since   1.0.0
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
     * @since   1.0.0
     */
    public function getFieldValue()
    {
        return $this->field_value;
    }

    /**
     * Set Options
     *
     * @param   array $options
     *
     * @return  $this
     * @since   1.0.0
     */
    public function setOptions($options)
    {
        if (is_array($options)) {
            $this->options = $options;
            return $this;
        }

        $this->options = array();

        return $this;
    }

    /**
     * Get Options
     *
     * @return  array
     * @since   1.0.0
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set Database
     *
     * @return  $this
     * @since   1.0.0
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
     * @since   1.0.0
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * Set Table
     *
     * @return  $this
     * @since   1.0.0
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
     * @since   1.0.0
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set Key
     *
     * @return  $this
     * @since   1.0.0
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
     * @since   1.0.0
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get timezone
     *
     * @return  array
     * @since   1.0.0
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
     * @since   1.0.0
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
     * @since   1.0.0
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
     * @since   1.0.0
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
     * @since   1.0.0
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
     * @since   1.0.0
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

    /**
     * Format Error Message
     *
     * $param   integer  $code
     *
     * @return  $this
     * @since   1.0.0
     */
    public function set_error_message($code)
    {
        $this->errors[$code] = trim($this->field_name) . ' Method Failed: ' . $this->method . $this->message;

        return $this;
    }
}
