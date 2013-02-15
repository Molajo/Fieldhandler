<?php
/**
 *Callback Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Type;

defined('MOLAJO') or die;

/**
 * Callback Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Callback extends AbstractFilter
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

        if (isset($this->options['callback'])) {
            $this->getCallback() = $this->options['callback'];
        } else {
            throw new FilterException('Filters Validate: '
            . 'Callback Object must be instantiated and injected into the $this->options associative array');
        }

        try {
            return $this->getCallback()->validate($this->getValue(), $this->getRequired(), $this->getDefault(), $this->getMin(), $this->getMax(), $this->getValues(), $this->options);
        }
        catch (Exception $e) {
            throw new FilterException('Filters Validate: Callback Exception Caught: ' . $e->message);
        }
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
        if (isset($this->options['callback'])) {
            $this->getCallback() = $this->options['callback'];
        } else {
            throw new FilterException('Filters Filter method: '
            . ' Callback Object must be instantiated and injected into the $this->options associative array');
        }

        try {
            return $this->getCallback()->filter($this->getValue(), $this->getRequired(), $this->getDefault(), $this->getMin(), $this->getMax(), $this->getValues(), $this->options);
        }
        catch (Exception $e) {
            throw new FilterException('Filters Filter: Callback Exception Caught: ' . $e->message);
        }
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
        if (isset($this->options['callback'])) {
            $this->getCallback() = $this->options['callback'];
        } else {
            throw new FilterException('Filters Escape: '
               . ' Callback Object must be instantiated and injected into the $this->options associative array');
        }

        try {
            return $this->getCallback()->validate($this->getValue());
        }
        catch (Exception $e) {
            throw new FilterException('Filters Validate: Callback Exception Caught: ' . $e->message);
        }
    }
}
