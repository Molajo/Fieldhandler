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
     * True array
     *
     * @var    array
     * @since  1.0.0
     */
    protected $true_array = array();

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
     * Standard Error Messages
     *
     * @var    array
     * @since  1.0.0
     */
    protected $standard_messages = array(
        1000  => '',
        2000  => '',
        3000  => '',
        4000  => '',
        5000  => '',
        6000  => '',
        7000  => '',
        8000  => '',
        9000  => '',
        10000 => '',
        11000 => '',
        12000 => '',
        13000 => '',
        14000 => '',
        15000 => '',
        16000 => '',
        17000 => '',
        18000 => '',
        19000 => '',
        20000 => '',
        21000 => '',
        22000 => '',
        23000 => '',
        24000 => '',
        25000 => '',
        26000 => '',
        27000 => '',
        28000 => '',
        29000 => '',
        30000 => '',
        31000 => '',
        32000 => '',
        33000 => '',
        34000 => '',
        35000 => '',
        36000 => '',
        37000 => '',
        38000 => '',
        39000 => '',
        40000 => '',
        41000 => '',
        42000 => '',
        43000 => '',
        44000 => '',
        45000 => '',
        46000 => '',
        47000 => '',
        48000 => '',
        49000 => ''
    );

    /**
     * Error Messages
     *
     * @var    array
     * @since  1.0.0
     */
    protected $error_messages = array();

    /**
     * Allowed Properties
     *
     * @var object
     * @since 1.0.0
     */
    protected $property_array = array(
        'database',
        'encoding',
        'error_messages',
        'html_entities',
        'key',
        'table',
        'timezone',
        'true_array',
        'white_list'
    );

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
    public function __construct($fieldhandler_type, $method, $field_name, $field_value, $options)
    {
        if (function_exists('date_default_timezone_set') && function_exists('date_default_timezone_get')) {
            date_default_timezone_set(@date_default_timezone_get());
        }

        $this->true_array[] = true;
        $this->true_array[] = 1;
        $this->true_array[] = 'yes';
        $this->true_array[] = 'on';

        $this->fieldhandler_type = $fieldhandler_type;
        $this->method            = $method;
        $this->field_name        = $field_name;
        $this->field_value       = $field_value;

        foreach ($this->property_array as $key) {
            if (isset($options[$key])) {
                $this->$key = $options[$key];
                unset($options[$key]);
            }
        }

        $this->options = $options;

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
     * Return error messages
     *
     * @return  array
     * @since   1.0.0
     */
    public function getErrorMessages()
    {
        return $this->error_messages;
    }

    /**
     * Set an error message
     *
     * $param   integer  $code
     *
     * @return  $this
     * @since   1.0.0
     */
    protected function setErrorMessage($code)
    {
        $this->error_messages[$code] = trim($this->field_name) . ' Method Failed: ' . $this->method . $this->message;

        return $this;
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

        $this->timezone = $timezone;

        return $this;
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
    protected function filterByCharacter($test, $filter)
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
}
