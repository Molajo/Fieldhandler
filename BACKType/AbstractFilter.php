<?php
/**
 * Abstract Filters Class
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Type;

defined('MOLAJO') or die;

use Exception;
use Molajo\Filters\Exception\FilterException;
use Molajo\Filters\Adapter\FilterInterface;

/**
 * Abstract Filters Class
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
abstract class AbstractFilter implements FilterInterface
{
    /**
     * Method (validate, filter, escape)
     *
     * @var    string
     * @since  1.0
     */
    protected $method;

    /**
     * Filter Type
     *
     * @var    mixed
     * @since  1.0
     */
    protected $filter_type;

    /** Data Values */

    /**
     * Data Value
     *
     * @var    mixed
     * @since  1.0
     */
    protected $value;

    /**
     * Default Value
     *
     * @var    object
     * @since  1.0
     */
    protected $default;

    /**
     * Required
     *
     * @var    boolean
     * @since  1.0
     */
    protected $required;

    /**
     * Minimum Value
     *
     * @var    integer
     * @since  1.0
     */
    protected $min;

    /**
     * Maximum Value
     *
     * @var    integer
     * @since  1.0
     */
    protected $max;

    /**
     * Valid Values
     *
     * @var    array
     * @since  1.0
     */
    protected $values;

    /**
     * Regex check
     *
     * @var    string
     * @since  1.0
     */
    protected $regex;

    /**
     * Callback
     *
     * @var    object
     * @since  1.0
     */
    protected $callback;

    /**
     * Options for custom filters
     *
     * @var    array
     * @since  1.0
     */
    protected $options;

    /**
     * Timezone
     *
     * @var    string
     * @since  1.0
     */
    protected $timezone;

    /**
     * Constructor
     *
     * @param   string   $method (validate, filter, escape)
     * @param   string   $filter_type
     *
     * @param   mixed    $value
     * @param   null     $default
     * @param   bool     $required
     * @param   null     $min
     * @param   null     $max
     * @param   array    $values
     * @param   string   $regex
     * @param   object   $callback
     * @param   array    $options
     *
     * @return  mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $filter_type,
        $value,
        $default = null,
        $required = true,
        $min = null,
        $max = null,
        $values = array(),
        $regex = null,
        $callback = null,
        $options = array()
    ) {
        return $this;
    }

    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function validate()
    {
        return $this->getValue();
    }

    /**
     * Filter Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function filter()
    {
        return $this->getValue();
    }

    /**
     * Escapes and formats output
     *
     * @return  mixed
     * @since   1.0
     */
    public function escape()
    {
        return $this->getValue();
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
            return;
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

        return;
    }

    /**
     * Required Check
     *
     * @return  void
     * @since   1.0
     */
    public function checkRequired()
    {
        if ($this->getRequired() === true) {
        } else {
            return;
        }

        if ($this->getValue() === null || $this->getValue() === '') {
            throw new \RuntimeException
            ('');
        }

        return;
    }

    /**
     * Set Default
     *
     * @return  void
     * @since   1.0
     */
    public function testDefault()
    {

        if ($this->getDefault() === null) {
            return;
        }

        if ($this->getValue() === null || $this->getValue() === '') {
            $this->setValue($this->getDefault());
        }

        return;
    }

    /**
     * Equals (Password validation)
     *
     * @return  void
     * @since   1.0
     */
    public function equalsValue()
    {
        if (preg_match($this->getRegex(), $this->equals_value)) {
        } else {
            return;
        }

        throw new FilterException
        ('');
    }

    /**
     * Minimum Check
     *
     * @return  void
     * @since   1.0
     */
    public function checkMinimum()
    {
//strtotime (if is date)
//size, files, strings
        if ($this->getMin() === null) {
            return;
        }

        if ($this->getValue() >= $this->getMin()) {
            return;
        }

        throw new \RuntimeException
        ('');

    }

    /**
     * Maximum Check
     *
     * @return  void
     * @since   1.0
     */
    public function checkMaximum()
    {

        if ($this->getMax() === null) {
            return;
        }

        if ($this->getValue() <= $this->getMax()) {
            return;
        }

        throw new \RuntimeException
        ('');
    }

    /**
     * Values Check
     *
     * @return  void
     * @since   1.0
     */
    public function checkValues()
    {
        if (is_array($this->getValues()) && count($this->getValues()) > 0) {
        } else {
            return;
        }

        if (in_array($this->getValue(), $this->getValues())) {
            return;
        }

        throw new FilterException
        ('');
    }

    /**
     * Named Pair Check
     *
     * @return  void
     * @since   1.0
     */
    public function checkNamedPairs()
    {
        if (isset($this->options['name_pair_array'])
            && isset($this->options['name_pair_key'])
        ) {
        } else {
            return;
        }

        if ($this->options['name_pair_array'][$this->options['name_pair_key']] == $this->getValue()) {
            return;
        }

        throw new FilterException
        ('');
    }

    /**
     * Regex Check
     *
     * @param   mixed    $value
     * @param   array    $regex
     *
     * @return  void
     * @since   1.0
     */
    public function checkRegex()
    {
        if (preg_match($this->getRegex(), $this->getValue())) {
        } else {
            return;
        }

        throw new FilterException
        ('');
    }

    /**
     * Callback Check
     *
     * Check database validity or verify against other data elements
     * or set the default outside of the checking
     * - runs instead ? or before? or after? or pass in errors?
     *
     * @return  void
     * @since   1.0
     */
    public function checkCallback()
    {

        if (isset($this->options['callback'])) {
            $callback = $this->options['callback'];
        } else {
            throw new FilterException('Filter: ' . $this->getFilterType()
                . '  Method: ' . $this->getMethod()
                . ' Callback Object must be instantiated and injected into the '
                . ' options associative array');
        }

        try {
            return $callback->filter();
        } catch (Exception $e) {
            throw new FilterException('Filters Filter: Callback Exception Caught: ' . $e->error_message);
        }
    }

    /**
     * trimValue
     *
     * @param   mixed    $value
     * @param   array    $this->options
     *
     * @return  void
     * @since   1.0
     */
    public function trimValue()
    {
        if (isset($this->options['trim'])) {
        } else {
            return;
        }

        return trim($this->getValue());
    }

    /**
     * filterText
     *
     * @return  void
     * @since   1.0
     */
    public function filterText()
    {
        if (isset($this->options['filter_text'])) {
        } else {
            return;
        }

        // allowraw, allowhtml, blacklist, whitelist
        $callback = $this->options['callback'];

        return trim($this->getValue());
    }

    /**
     * checkExtension
     *
     * @return  void
     * @since   1.0
     */
    public function checkExtension()
    {
        if (isset($this->options['extension_types'])) {
        } else {
            return;
        }

        // jpeg, png, bmp, or gif)
        $callback = $this->options['callback'];

        return;
    }

    /**
     * checkExtension
     *
     * @return  void
     * @since   1.0
     */
    public function checkMimetype()
    {
        if (isset($this->options['extension_types'])) {
        } else {
            return;
        }

        // jpeg, png, bmp, or gif)
        $callback = $this->options['callback'];

        return;
    }

    /**
     * Getters and Setters
     *
     * Set the Method
     *
     * @param   string  $method
     *
     * @return  string
     * @since   1.0
     */
    protected function setMethod($method)
    {
        if ($method == 'validate'
            || $method == 'filter'
            || $method == 'escape'
        ) {
        } else {
            throw new FilterException
            ('');
        }

        $this->method = $method;

        return;
    }

    /**
     * Get the Path
     *
     * @return  string
     * @since   1.0
     */
    protected function getMethod()
    {
        return $this->method();
    }

    /**
     * Set the Filter Type
     *
     * @param   string  $method
     *
     * @return  string
     * @since   1.0
     */
    protected function setFilterType($filter_type)
    {
        $this->filter_type = $filter_type;

        return;
    }

    /**
     * Get the Filter Type
     *
     * @return  string
     * @since   1.0
     */
    protected function getFilterType()
    {
        return $this->filter_type;
    }


    /**
     * Set the Value
     *
     * @param   string  $value
     *
     * @return  void
     * @since   1.0
     */
    protected function setValue($value)
    {
        $this->value = $value;

        return;
    }

    /**
     * Get Value
     *
     * @return  mixed
     * @since   1.0
     */
    protected function getValue()
    {
        return $this->value;
    }

    /**
     * Set the Default
     *
     * @param   string  $default
     *
     * @return  void
     * @since   1.0
     */
    protected function setDefault($default)
    {
        $this->default = $default;

        return;
    }

    /**
     * Get the Default
     *
     * @return  string
     * @since   1.0
     */
    protected function getDefault()
    {
        return $this->default;
    }

    /**
     * Set Required
     *
     * @param   bool  $required
     *
     * @return  string
     * @since   1.0
     */
    protected function setRequired($required)
    {
        if ($required == true) {
            $this->required = true;
        } else {
            $this->required = false;
        }

        return;
    }

    /**
     * Get Required
     *
     * @return  bool
     * @since   1.0
     */
    protected function getRequired()
    {
        return $this->required;
    }

    /**
     * Set the Min
     *
     * @param   int  $min
     *
     * @return  void
     * @since   1.0
     */
    protected function setMin($min)
    {
        $this->min = $min;

        return;
    }

    /**
     * Get the Min
     *
     * @return  int
     * @since   1.0
     */
    protected function getMin()
    {
        return $this->min;
    }

    /**
     * Set the Max
     *
     * @param   int  $max
     *
     * @return  void
     * @since   1.0
     */
    protected function setMax($max)
    {
        $this->max = $max;

        return;
    }

    /**
     * Get the Max
     *
     * @return  int
     * @since   1.0
     */
    protected function getMax()
    {
        return $this->max;
    }

    /**
     * Set the Values array
     *
     * @param   string  $values
     *
     * @return  void
     * @since   1.0
     */
    protected function setValues($values = array())
    {
        $this->values = $values;

        return;
    }

    /**
     * Get the Values array
     *
     * @return  array
     * @since   1.0
     */
    protected function getValues()
    {
        return $this->values;
    }

    /**
     * Set Regex
     *
     * @param   string  $regex
     *
     * @return  void
     * @since   1.0
     */
    protected function setRegex($regex)
    {
        $this->regex = $regex;

        return;
    }

    /**
     * Get the Regex
     *
     * @return  string
     * @since   1.0
     */
    protected function getRegex()
    {
        return $this->regex;
    }

    /**
     * Set the Callback
     *
     * @param   object  $callback
     *
     * @return  void
     * @since   1.0
     */
    protected function setCallback($callback)
    {
        $this->callback = $callback;

        return;
    }

    /**
     * Get the Callback object
     *
     * @return  object
     * @since   1.0
     */
    protected function getCallback()
    {
        return $this->callback;
    }

    /**
     * Set Options
     *
     * @param   string  $options
     *
     * @return  void
     * @since   1.0
     */
    protected function setOptions($options)
    {
        $this->options = $options;

        return;
    }

    /**
     * Get Options
     *
     * @return  array
     * @since   1.0
     */
    protected function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the Timezone
     *
     * @param   string  $timezone
     *
     * @return  string
     * @since   1.0
     */
    protected function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return;
    }

    /**
     * Get the Timezone
     *
     * @return  string
     * @since   1.0
     */
    protected function getTimezone()
    {
        return $this->timeone;
    }

}
