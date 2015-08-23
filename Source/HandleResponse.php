<?php
/**
 * Handle Response
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use CommonApi\Fieldhandler\HandleResponseInterface;

/**
 * Handle Response
 *
 * @package    Molajo
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
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
        if ($this->testNoValueChange() === true) {
            return true;
        }

        if ($this->testFloat() === true) {
            return true;
        }

        if ($this->original_data_value === $this->response_value) {
            return false;
        }

        return true;
    }

    /**
     * Test for "no value" changes
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testNoValueChange()
    {
        $change = $this->testNoValueChangeCompare(null, false);
        if ($change === true) {
            return true;
        }

        $change = $this->testNoValueChangeCompare(false, null);
        if ($change === true) {
            return true;
        }

        $change = $this->testNoValueChangeCompare(0, null);
        if ($change === true) {
            return true;
        }

        return false;
    }

    /**
     * Test for "no value" changes
     *
     * @param false $response
     *
     * @return  boolean $original
     * @return  boolean $response
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testNoValueChangeCompare($original = null, $response = null)
    {
        if ($this->original_data_value === $original
            && $this->response_value === $response
        ) {
            return true;
        }

        return false;
    }

    /**
     * Due to type differences, cannot only use strict testing (ex. 123 (int) <> 123 (double) )
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testFloat()
    {
        $change = false;

        if (is_numeric($this->original_data_value)) {

            if ((float)$this->original_data_value < (float)$this->response_value
                || (float)$this->response_value < (float)$this->original_data_value
            ) {
                $change = true;
            }
        }

        return $change;
    }
}
