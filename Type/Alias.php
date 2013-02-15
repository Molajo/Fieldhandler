<?php
/**
 * Alias Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Type;

defined('MOLAJO') or die;

/**
 * Alias Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Alias extends AbstractFilter
{
    /**
     * Constructor
     *
     * @param   string   $method (validate, filter, escape)
     * @param   string   $filter_type
     *
     * @param   mixed    $this->getValue()
     * @param   null     $this->getDefault()
     * @param   bool     $this->getRequired()
     * @param   null     $this->getMin()
     * @param   null     $this->getMax()
     * @param   array    $this->getValues()
     * @param   string   $this->getRegex()
     * @param   object   $this->getCallback()
     * @param   array    $this->options
     *
     * @return  mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $filter_type,
        $this->getValue(),
        $this->getDefault() = null,
        $this->getRequired() = true,
        $this->getMin() = null,
        $this->getMax() = null,
        $this->getValues() = array(),
        $this->getRegex() = null,
        $this->getCallback() = null,
        $this->options = array()
    ) {
        if (defined('FILTER_VALUE_REQUIRED')) {
        } else {
            $this->defines();
        }
    }

    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function validate()
    {
        $test = $this->createAlias();

        if ($test == $this->getValue()) {
            return $this->getValue();
        }

        throw new FilterException(__CLASS__ . ' ' . FILTER_VALUE_INVALID);
    }


    /**
     * Filter Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function filter()
    {
        if ($this->getDefault() == null) {
        } else {
            $this->getValue() = $this->getDefault();
        }

        if ($this->getValue() === null) {
            $this->getValue() = $this->efault;
        }

        $this->getValue() = $this->createAlias($this->getValue());

        if ($this->getValue() === null
            && $this->getRequired() == 0
        ) {
            throw new FilterException(__CLASS__ . ' ' . FILTER_VALUE_REQUIRED);
        }

        return $this->getValue();
    }

    /**
     * Create Alias from Text Value
     *
     * @param $this->getValue()
     *
     * @return mixed
     * @since  1.0
     */
    public function createAlias($this->getValue())
    {
        if ($this->getValue() === null) {
        } else {
            $test = filter_var($this->getValue(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            /** Replace dashes with spaces */
            $this->getValue() = str_replace('-', ' ', strtolower(trim($this->getValue())));

            /** Removes double spaces, ensures only alphanumeric characters */
            $this->getValue() = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $this->getValue());

            /** Trim dashes at beginning and end */
            $this->getValue() = trim($this->getValue(), '-');

            /** Replace spaces with underscores */
            $this->getValue() = str_replace(' ', '_', strtolower(trim($this->getValue())));
        }

        return $this->getValue();
    }

    /**
     * Escapes and formats output
     *
     * @param   mixed    $this->getValue()
     * @param   array    $this->options
     *
     * @return  mixed
     * @since   1.0
     */
    public function escape($this->getValue(), $this->options = array())
    {
        return $this->createAlias($this->getValue());
    }
}
