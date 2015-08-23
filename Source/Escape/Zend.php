<?php
/**
 * Escape Adapter for Zend Escaper
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Escape;

use CommonApi\Fieldhandler\EscapeInterface;

/**
 * Escape Adapter for Zend Escaper
 *
 * @package    Molajo
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @since      1.0.0
 */
final class Zend extends AbstractEscape implements EscapeInterface
{
    /**
     * Escape Html
     *
     * @link    http://zf2.readthedocs.org/en/latest/modules/zend.escaper.escaping-html.html
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeHtml($string)
    {
        return $this->escape_instance->escapeHtml($string);
    }

    /**
     * Escape Html Attributes
     *
     * @link    http://zf2.readthedocs.org/en/latest/modules/zend.escaper.escaping-html-attributes.html
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeHtmlAttributes($string)
    {
        return $this->escape_instance->escapeHtmlAttr($string);
    }

    /**
     * Escape Js
     *
     * http://zf2.readthedocs.org/en/latest/modules/zend.escaper.escaping-javascript.html
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeJs($string)
    {
        return $this->escape_instance->escapeJs($string);
    }

    /**
     * Escape Css
     *
     * @url     http://zf2.readthedocs.org/en/latest/modules/zend.escaper.escaping-css.html
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeCss($string)
    {
        return $this->escape_instance->escapeCss($string);
    }

    /**
     * Escape Url
     *
     * @url     http://zf2.readthedocs.org/en/latest/modules/zend.escaper.escaping-url.html
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeUrl($string)
    {
        return $this->escape_instance->escapeUrl($string);
    }
}
