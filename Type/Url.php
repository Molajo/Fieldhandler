<?php
/**
 *Url Filters
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
 * Url Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Url extends AbstractFilter
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
            //checkdnsrr
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
        } else {
            $test = filter_var($this->getValue(), FILTER_SANITIZE_URL);
            if (filter_var($test, FILTER_VALIDATE_URL)) {
                return $test;
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
     * @param   mixed    $this->getValue()
     *
     * @return  mixed
     * @since   1.0
     */
    public function escape($this->getValue(), $this->options = array())
    {
        if (Services::Application()->get('url_unicode_slugs') == 1) {
//            return FilterOutput::stringURLUnicodeSlug($url);
        } else {
//            return FilterOutput::stringURLSafe($url);
        }
    }
}

