<?php
/**
 * Accepted Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Accepted Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Accepted extends AbstractFieldhandler implements FieldhandlerAdapterInterface
{
    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return false;

        } else {
            $testValue = $this->field_value;

            if (is_numeric($testValue) || is_bool($testValue)) {
            } else {
                $testValue = strtolower($testValue);
            }

            if (in_array($testValue, $this->true_array, true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Filter Input
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function filter()
    {
        if ($this->field_value === null) {

        } else {
            $testValue = $this->field_value;

            if (is_numeric($testValue) || is_bool($testValue)) {
            } else {
                $testValue = strtolower($testValue);
            }

            if (in_array($testValue, $this->true_array, true)) {
            } else {
                $this->field_value = null;
            }
        }

        return $this->field_value;
    }

    /**
     * Escapes and formats output
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function escape()
    {
        return $this->filter();
    }
}
