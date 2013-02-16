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
     * @param   mixed    $value
     * @param   array    $options
     *
     * @return  mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $filter_list,
        $value,
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
        return $this->timezone;
    }

    /**
     * Test the string specified in $filter using the function defined by $test
     *
     * @param   string  $filter
     *
     * @return  string
     * @since   1.0
     */
    protected function filterByCharacter($filter, $test)
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
