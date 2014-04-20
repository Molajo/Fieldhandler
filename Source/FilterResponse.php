<?php
/**
 * Filter Response
 *
 * @package    Fieldhandler
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use CommonApi\Model\FilterResponseInterface;

/**
 * Filter Response
 *
 * @package    Fieldhandler
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @since      1.0.0
 */
class FilterResponse implements FilterResponseInterface
{
    /**
     * Original Data Value
     *
     * @var    mixed
     * @since  1.0.0
     */
    protected $original_data_value;

    /**
     * Filter Response
     *
     * @var    mixed
     * @since  1.0.0
     */
    protected $filter_response;

    /**
     * Constructor
     *
     * @param   mixed $filtered_value
     * @param   mixed $original_data_value
     *
     * @since   1.0.0
     */
    public function __construct(
        $original_data_value,
        $filtered_value
    ) {
        $this->original_data_value = $original_data_value;
        $this->filtered_value      = $filtered_value;
    }

    /**
     * Get Filtered Value
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getFilteredValue()
    {
        return $this->filtered_value;
    }

    /**
     * Did the data value change as a result of filtering?
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function getChangeIndicator()
    {
        if ($this->original_data_value === $this->filtered_value) {
            return false;
        }

        return true;
    }
}
