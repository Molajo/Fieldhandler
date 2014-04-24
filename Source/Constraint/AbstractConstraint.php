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
     * @var    string
     * @since  1.0.0
     */
    protected $constraint;

    /**
     * Method (validate, sanitize, format)
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
     * Available Options defined within properties by Constraint
     *
     * @var    array
     * @since  1.0.0
     */
    protected $constraint_allowable_options = array();

    /**
     * Requested Options for Constraint
     *
     * @var    string
     * @since  1.0.0
     */
    protected $selected_constraint_options = null;

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
     * @var    object
     * @since  1.0.0
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
     * Get Validate Messages
     *
     * @return  array
     * @since   1.0.0
     */
    public function getValidateMessages()
    {
        return $this->validate_messages;
    }

    /**
     * Save Code for Validate Message
     *
     * @param   string $message_code
     *
     * @return  $this
     * @since   1.0.0
     */
    public function setValidateMessage($message_code)
    {
        $this->validate_messages[] = $message_code;

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
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    abstract public function sanitize();

    /**
     * Format
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    abstract public function format();

    /**
     * Get timezone
     *
     * @return  array
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

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function setFlags()
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
     * Get Option
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getOption($key, $default = null)
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
}
