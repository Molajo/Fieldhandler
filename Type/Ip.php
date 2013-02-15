<?php
/**
 * Local Adapter for Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Type;

defined('MOLAJO') or die;

use Molajo\Filters\Exception\FilterException;

/**
 * Ip Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Ip extends AbstractFilter
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
            $flags = 0;
            if ($this->options['ipv4']) {
                $flags |= FILTER_FLAG_IPV4;
            }
            if ($this->options['ipv6']) {
                $flags |= FILTER_FLAG_IPV6;
            }
            if (!$this->options['private']) {
                $flags |= FILTER_FLAG_NO_PRIV_RANGE;
            }
            if (!$this->options['reserved']) {
                $flags |= FILTER_FLAG_NO_RES_RANGE;
            }

            return filter_var($var, FILTER_VALIDATE_IP, $flags);
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
        } elseif ($this->getValue() === null) {
            $this->getValue() = $this->getDefault();
        }

        if ($this->getValue() === null) {
        } else {
            $this->getValue() = filter_var($this->getValue(), FILTER_SANITIZE_IP);

            $test = filter_var($this->getValue(), FILTER_VALIDATE_IP);
        }

        if ($test == $this->getValue()) {
        } else {
            throw new FilterException('FILTER_INVALID_VALUE');
        }


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
     * @param   mixed    $this->getValue()
     *
     * @return  mixed
     * @since   1.0
     */
    public function escape($this->getValue(), $this->options = array())
    {
        return filter_var($this->getValue(), FILTER_SANITIZE_IP);
    }
}
