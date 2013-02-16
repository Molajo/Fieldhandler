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
        parent::filter();

        if ($this->getValue() === null) {
        } else {
            $test = filter_var($this->getValue(), FILTER_VALIDATE_ALNUM);
        }

        if ($this->getValue() === null
            && $this->getRequired() == 0
        ) {
            throw new FilterException(__CLASS__ . ' ' . FILTER_VALUE_REQUIRED);
        }

        $this->createAlias($this->getValue());

        if ($this->getValue() === null
            && $this->getRequired() == 0
        ) {
            throw new FilterException(__CLASS__ . ' ' . FILTER_VALUE_REQUIRED);
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

        return $this->createAlias($this->getValue());
    }

    /**
     * Create Alias from Text Value
     *
     * @return mixed
     * @since  1.0
     */
    public function createAlias()
    {
        if ($this->getValue() === null) {
        } else {
            $alias = filter_var($this->getValue(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            /** Replace dashes with spaces */
            $alias = str_replace('-', ' ', strtolower(trim($alias)));

            /** Removes double spaces, ensures only alphanumeric characters */
            $alias = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $alias);

            /** Trim dashes at beginning and end */
            $alias = trim($alias, '-');

            /** Replace spaces with underscores */
            $alias = str_replace(' ', '_', strtolower(trim($alias)));

            $this->setValue($alias);
        }

        return $this->getValue();
    }
}


