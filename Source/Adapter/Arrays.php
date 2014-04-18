<?php
/**
 * Arrays Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Arrays Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Arrays extends AbstractFieldhandler implements FieldhandlerAdapterInterface
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
            return true;
        }

        if (is_array($this->field_value)) {
        } else {
            return false;
        }

        return $this->testValues(false);
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

            if (is_array($this->field_value)) {

            } else {
                $temp              = array();
                $temp[]            = $this->field_value;
                $this->field_value = $temp;
            }

            $this->testValues(true);
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

    /**
     * Test Array Entry Values
     *
     * @param   boolean $filter
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testValues($filter = false)
    {
        if (isset($this->options['array_valid_values'])) {
        } else {
            return true;
        }

        $array_valid_values = $this->options['array_valid_values'];

        if (is_array($array_valid_values) && count($array_valid_values) > 0) {
        } else {
            return true;
        }

        $entries = $this->field_value;

        foreach ($entries as $entry) {

            if (in_array($entry, $array_valid_values)) {

            } else {

                if ($filter === true) {
                    unset ($entry);
                } else {
                    return false;
                }
            }
        }

        if ($filter === true) {
            $this->field_value = $entries;
        }

        return true;
    }
}
