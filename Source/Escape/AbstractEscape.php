<?php
/**
 * Abstract Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Escape;

use CommonApi\Model\EscapeInterface;

/**
 * Abstract Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractEscape implements EscapeInterface
{
    /**
     * Escape Adapter
     *
     * @var    object
     * @since  1.0.0
     */
    protected $escape_instance;

    /**
     * Constructor
     *
     * @param   object  $escape_instance
     *
     * @since   1.0.0
     */
    public function __construct($escape_instance)
    {
        $this->escape_instance = $escape_instance;
    }

    /**
     * Html
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    abstract public function escapeHtml($string);

    /**
     * Html Attributes
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    abstract public function escapeHtmlAttributes($string);

    /**
     * Js
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    abstract public function escapeJs($string);

    /**
     * Url
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    abstract public function escapeUrl($string);

    /**
     * Css
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    abstract public function escapeCss($string);
}
