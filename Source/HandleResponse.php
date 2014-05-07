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
        if ($this->testNoValueChange() === TRUE) {
            return TRUE;
        }

        if ($this->testFloat() === TRUE) {
            return TRUE;
        }

        if ($this->original_data_value === $this->response_value) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Test for "no value" changes
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testNoValueChange()
    {
        $change = $this->testNoValueChangeCompare(NULL, FALSE);
        if ($change === TRUE) {
            return TRUE;
        }

        $change = $this->testNoValueChangeCompare(FALSE, NULL);
        if ($change === TRUE) {
            return TRUE;
        }

        $change = $this->testNoValueChangeCompare(0, NULL);
        if ($change === TRUE) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Test for "no value" changes
     *
     * @return  NULL|mixed  $original
     * @return  NULL|mixed  $response
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testNoValueChangeCompare($original = NULL, $response = NULL)
    {
        if ($this->original_data_value === $original
            && $this->response_value === $response
        ) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Due to type differences, cannot only use strict testing (ex. 123 (int) <> 123 (double) )
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testFloat()
    {
        $change = FALSE;

        if (is_numeric($this->original_data_value)) {

            if ((float)$this->original_data_value < (float)$this->response_value
                || (float)$this->response_value < (float)$this->original_data_value
            ) {
                $change = TRUE;
            }
        }

        return $change;
    }
}
