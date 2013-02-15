<?php
/**
 * Date Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Type;

defined('MOLAJO') or die;

/**
 * Date Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Date extends AbstractFilter
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
        } elseif ($this->getValue() === null
            || $this->getValue() == ''
            || $this->getValue() == 0
        ) {
            $this->getValue() = $this->getDefault();
        }

        if ($this->getValue() === null
            || $this->getValue() == '0000-00-00 00:00:00'
        ) {

        } else {
            $dd   = substr($this->getValue(), 8, 2);
            $mm   = substr($this->getValue(), 5, 2);
            $ccyy = substr($this->getValue(), 0, 4);

            if (checkdate((int)$mm, (int)$dd, (int)$ccyy)) {
            } else {
                throw new FilterException('FILTER_INVALID_VALUE');
            }
            $test = $ccyy . '-' . $mm . '-' . $dd;

            if ($test == substr($this->getValue(), 0, 10)) {
                return $this->getValue();
            } else {
                throw new FilterException('FILTER_INVALID_VALUE');
            }
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
     * @param   mixed  $this->getValue()
     *
     * @return  mixed
     * @since   1.0
     */
    public function escape($this->getValue(), $this->options = array())
    {
        //timezone

        return htmlentities($this->getValue(), ENT_QUOTES, 'UTF-8');
    }
}
