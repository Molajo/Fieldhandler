<?php
/**
 *Html Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Type;

defined('MOLAJO') or die;

use Exception;
use RuntimeException;


use Molajo\Filters\Adapter\FilterInterface;
use Molajo\Filters\Exception\FilterException;

/**
 * Html Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Html extends AbstractFilter
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
    } elseif ($this->getValue() === null) {
        $this->getValue() = $this->getDefault();
    }

    if ($this->getValue() === null) {
    } else {
        $this->getValue() = filter_var($this->getValue(), FILTER_UNSAFE_RAW);
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
        //striptags
        //nl2br
        //upper
        //lower
        //reverse
        //length
        //raw
        //trim
        // htmlspecialchars($var, ENT_QUOTES, 'UTF-8')
        return filter_var($this->getValue(), FILTER_UNSAFE_RAW);
    }
}

