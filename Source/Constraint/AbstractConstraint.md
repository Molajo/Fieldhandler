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
     * Request
     *
     * @var    string
     * @since  1.0.0
     */
    protected $constraint;

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
     * False array
     *
     * @var    array
     * @since  1.0.0
     */
    protected $false_array = array();

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
     * Properties
     *
     * @var object
     * @since 1.0.0
     */
    protected $property_array = array(
        'database',
        'encoding',
        'false_array',
        'html_entities',
        'key',
        'table',
        'timezone',
        'true_array',
        'white_list'
    );

    /**
     * Validation Messages
     *
     * @var    array
     * @since  1.0.0
     */
    protected $validation_messages = array();

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
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function __construct($constraint, $method, $field_name, $field_value, $options)
    {
        if (function_exists('date_default_timezone_set') && function_exists('date_default_timezone_get')) {
            date_default_timezone_set(@date_default_timezone_get());
        }

        $this->true_array[true]  = true;
        $this->true_array[1]     = 1;
        $this->true_array['yes'] = 'yes';
        $this->true_array['on']  = 'on';

        $this->false_array[false] = false;
        $this->false_array[0]     = 0;
        $this->false_array['no']  = 'no';
        $this->false_array['off'] = 'off';

        $this->constraint  = $constraint;
        $this->method      = $method;
        $this->field_name  = $field_name;
        $this->field_value = $field_value;

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
     * Get Messages
     *
     * @return  array
     * @since   1.0.0
     */
    public function getValidationMessages()
    {
        return $this->validation_messages;
    }

    /**
     * Save Message Codes  for Validation Failures
     *
     * @param   string $message_code
     *
     * @return  $this
     * @since   1.0.0
     */
    public function setValidationMessage($message_code)
    {
        $this->validation_messages[] = $message_code;

        return $this;
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

    /**
     * Get Minimum and Maximum
     *
     * @return  array
     * @since   1.0.0
     */
    public function testMinimumMaximumLength()
    {
        $minimum = 0;
        $maximum = 999999999999;

        if (isset($this->options['minimum_length'])) {
            $minimum = $this->options['minimum_length'];
        }

        if (isset($this->options['maximum_length'])) {
            $maximum = $this->options['maximum_length'];
        }

        $string_length = strlen(trim($this->field_value));

        if ($string_length >= $minimum
            && $string_length <= $maximum
        ) {
            return true;
        }

        return array($minimum, $maximum);
    }
}
