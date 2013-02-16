<?php
/**
 * Array Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Type;

defined('MOLAJO') or die;

use Molajo\Filters\Adapter\FilterInterface;
use Molajo\Filters\Exception\FilterException;

/**
 * Array Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Arrayfilter extends AbstractFilter
{
    /**
     * Validate Input
     *
     * @param   mixed    $this->getValue()
     * @param   bool     $this->getRequired()
     * @param   null     $this->getDefault()
     * @param   null     $this->getMin()
     * @param   null     $this->getMax()
     * @param   array    $this->getValues()
     * @param   array    $this->options
     *
     * @return  mixed
     * @since   1.0
     */
    public function validate(
            $this->getValue(),
        $this->getRequired() = true,
        $this->getDefault() = null,
        $this->getMin() = null,
        $this->getMax() = null,
        $this->getValues() = array(),
        $this->options = array()
    ) {
        if (is_array($this->getValue())) {
            return $this->getValue();
        }

throw new FilterException(__CLASS__ . FILTER_INVALID_VALUE . ' Not an array.');
}

/**
 * Filter Input
 *
 * @param   mixed    $this->getValue()
 * @param   bool     $this->getRequired()
 * @param   null     $this->getDefault()
 * @param   null     $this->getMin()
 * @param   null     $this->getMax()
 * @param   array    $this->getValues()
 * @param   array    $this->options
 *
 * @return  mixed
 * @since   1.0
 */
public function filter(
        $this->getValue(),
        $this->getRequired() = true,
        $this->getDefault() = null,
        $this->getMin() = null,
        $this->getMax() = null,
        $this->getValues() = array(),
        $this->options = array()
    ) {
    if ($this->getDefault() == null) {
    } else {
        $this->getValue() = $this->getDefault();
    }

    if ($this->getValue() === null) {
        $this->getValue() = $this->getDefault();
    }

    if ($this->getValue() === null
        && $this->getRequired() == 0
    ) {
        throw new FilterException(__CLASS__ . ' ' . FILTER_VALUE_REQUIRED);
    }

    if ($this->getValue() === null) {
        $this->getValue() = array();
    } else {
        if (is_array($this->getValue())) {

        } else {
            throw new FilterException(__CLASS__ . ' ' . FILTER_INVALID_VALUE);
        }
    }

    return $this->getValue();
}

    /**
     * Escapes and formats output
     *
     * @param   mixed    $this->getValue()
     *
     * @return  mixed
     * @since   1.0
     */
    public function escape($this->getValue(), $this->options = array())
    {
        if (isset($this->options['sort'])) {
            sort($this->getValue());
        }

        if (isset($this->options['limit'])) {
            $limit     = (int)$this->options['limit'];
            $newValues = array();
            if (is_array($this->getValue()) && count($this->getValue()) > 0) {
                for ($i = 0; $i < (int)$limit; $i ++) {
                    $newValues = $$this->getValue()[$i];
                }
            }
            $this->getValue() = $newValues;
        }

        if (is_array($this->getValue())) {
            return $this->getValue();
        }

        return array();
    }
}
