<?php
/**
 * Arrays Filter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Type;

defined('MOLAJO') or die;

/**
 * Arrays Filter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Arrays extends AbstractFilter
{
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
        return parent::__construct();
    }

    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function validate()
    {
        parent::validate();

        if ($this->getValue() === null) {
        } else {

            $test = is_array($this->getValue());

            if ($test == 1) {
            } else {
                throw new FilterException
                ('Validate Array: ' . FILTER_INVALID_VALUE);
            }

            $this->testValues();
        }

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
        parent::filter();

        if ($this->getValue() === null) {
        } else {

            $test = is_array($this->getValue());

            if ($test == 1) {
            } else {
                $temp   = array();
                $temp[] = $this->getValue();
                $this->setValue($temp);
            }

            $this->testValues();
        }

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
        parent::escape();

        $temp   = array();
        $temp[] = $this->getValue();
        $this->setValue($temp);

        $this->testValues();

        return $this->getValue();
    }

    /**
     * Test Array Entry Values
     *
     * @return  mixed
     * @since   1.0
     */
    public function testValues($filter = false)
    {
        $values = array();

        if (isset($this->options['array_valid_values'])) {
            $values = $this->options['array_valid_values'];
        }

        if (is_array($values) || count($values) === 0) {
            return;
        }

        $entries = $this->getValue();

        foreach ($entries as $entry) {
            if (in_array($entry, $values)) {
            } else {
                if ($filter === true) {
                    unset ($entry);
                } else {
                    throw new FilterException
                    ('Filters Arrays: Array Value is not valid');
                }
            }
        }

        $this->setValue($entries);

        return;
    }
}
