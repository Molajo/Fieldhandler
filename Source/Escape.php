<?php
/**
 * Proxy to Escape Adapter
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use CommonApi\Fieldhandler\EscapeInterface;

/**
 * Proxy to Escape Adapter
 *
 * @package    Molajo
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @since      1.0.0
 */
class Escape implements EscapeInterface
{
    /**
     * Escape Adapter
     *
     * @var    object
     * @since  1.0.0
     */
    protected $adapter;

    /**
     * Constructor
     *
     * @param   $adapter  \CommonApi\Fieldhandler\EscapeInterface
     *
     * @since   1.0.0
     */
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Escape Html
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeHtml($string)
    {
        return $this->adapter->escapeHtml($string);
    }

    /**
     * Escape Html Attributes
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeHtmlAttributes($string)
    {
        return $this->adapter->escapeHtmlAttributes($string);
    }

    /**
     * Escape Js
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeJs($string)
    {
        return $this->adapter->escapeJs($string);
    }

    /**
     * Escape Css
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeCss($string)
    {
        return $this->adapter->escapeCss($string);
    }

    /**
     * Escape Url
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeUrl($string)
    {
        return $this->adapter->escapeUrl($string);
    }
}
