<?php
/**
 * Escape Response
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use CommonApi\Model\EscapeResponseInterface;

/**
 * Escape Response
 *
 * @package    Molajo
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @since      1.0.0
 */
class EscapeResponse implements EscapeResponseInterface
{
    /**
     * Original Data Value
     *
     * @var    mixed
     * @since  1.0.0
     */
    protected $original_data_value;

    /**
     * Escape Response
     *
     * @var    mixed
     * @since  1.0.0
     */
    protected $escape_response;

    /**
     * Constructor
     *
     * @param   mixed $escaped_value
     * @param   mixed $original_data_value
     *
     * @since   1.0.0
     */
    public function __construct(
        $original_data_value,
        $escaped_value
    ) {
        $this->original_data_value = $original_data_value;
        $this->escaped_value       = $escaped_value;
    }

    /**
     * Get Escaped Value
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getEscapedValue()
    {
        return $this->escaped_value;
    }

    /**
     * Did the data value change as a result of escaping the data?
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function getChangeIndicator()
    {
        if ($this->original_data_value === $this->escaped_value) {
            return false;
        }

        return true;
    }
}
