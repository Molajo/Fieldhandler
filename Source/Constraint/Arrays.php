<?php
/**
 * Array Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Arrays Constraint
 *
 * @link       http://php.net/manual/en/function.is-array.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Arrays extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        $edits_passed = true;

        if (is_array($this->field_value)) {
        } else {
            $this->setValidateMessage(3000);
            $edits_passed = false;
        }

        if ($this->testValues(false) === false) {
            $this->setValidateMessage(4000);
            $edits_passed = false;
        }

        if ($this->testKeys(false) === false) {
            $this->setValidateMessage(5000);
            $edits_passed = false;
        }

        if ($this->testCount(false) === false) {
            $this->setValidateMessage(6000);
            $edits_passed = false;
        }

        if ($edits_passed === false) {
            return false;
        }

        return true;
    }

    /**
     * Handle Input
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function handleInput()
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

            $this->testKeys(true);

            $this->testCount(true);
        }

        return $this->field_value;
    }

    /**
     * Handle Output
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function handleOutput()
    {
        return $this->handleInput();
    }

    /**
     * Test Array Entry Keys
     *
     * @param   boolean $handleInput
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testKeys($filter = false)
    {
        if (isset($this->options['array_valid_keys'])) {
        } else {
            return true;
        }

        $array_valid_values = $this->options['array_valid_keys'];

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

    /**
     * Test Array Entry Values
     *
     * @param   boolean $filter
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testCount($filter = false)
    {
        if (isset($this->options['array_minimum'])) {
            $array_minimum = (int)$this->options['array_minimum'];
        } else {
            $array_minimum = 0;
        }

        if (isset($this->options['array_maximum'])) {
            $array_maximum = (int)$this->options['array_maximum'];
        } else {
            $array_maximum = 9999999999;
        }

        if (count($this->field_value) < $array_minimum
            || count($this->field_value) > $array_maximum
        ) {

            if ($filter === true) {
                $this->field_value = null;
            }

            return false;
        }

        return true;
    }
}
