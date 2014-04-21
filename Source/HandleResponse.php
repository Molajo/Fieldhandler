<?php
/**
 * Handle Response
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use CommonApi\Model\HandleResponseInterface;

/**
 * Handle Response
 *
 * @package    Molajo
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @since      1.0.0
 */
class HandleResponse implements HandleResponseInterface
{
    /**
     * Original Data Value
     *
     * @var    mixed
     * @since  1.0.0
     */
    protected $original_data_value;

    /**
     * Handle Value
     *
     * @var    mixed
     * @since  1.0.0
     */
    protected $response_value;

    /**
     * Constructor
     *
     * @param   mixed $original_data_value
     * @param   mixed $response_value
     *
     * @since   1.0.0
     */
    public function __construct(
        $original_data_value,
        $response_value
    ) {
        $this->original_data_value = $original_data_value;
        $this->response_value      = $response_value;
    }

    /**
     * Get Response Value
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getFieldValue()
    {
        return $this->response_value;
    }

    /**
     * Did the data value change as a result of processing?
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function getChangeIndicator()
    {
        if ($this->original_data_value === $this->response_value) {
            return false;
        }

        return true;
    }
}
