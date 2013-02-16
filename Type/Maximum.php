<?php
/**
 * Maximum Filter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Type;

defined('MOLAJO') or die;

/**
 * Maximum Filter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Maximum extends AbstractFilter
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

            if ($this->getMaximum() < $this->getValue()) {
            } else {
                throw new FilterException
                ('Validate Maximum: ' . FILTER_INVALID_VALUE);
            }
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

            if ($this->getMaximum() < $this->getValue()) {
            } else {
                $this->setValue($this->getMaximum());
            }
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

        if ($this->getValue() === null) {
        } else {

            if ($this->getMaximum() < $this->getValue()) {
            } else {
                $this->setValue($this->getMaximum());
            }
        }

        return $this->getValue();
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0
     */
    public function getMaximum()
    {
        $value = '';

        if (isset($this->options['maximum'])) {
            $value = $this->options['maximum'];
        }

        return $value;
    }
}
