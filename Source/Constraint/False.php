<?php
/**
 * False Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * False Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class False extends AbstractConstraint implements ConstraintInterface
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

        } else {
            $testValue = $this->field_value;

            if (is_numeric($testValue) || is_bool($testValue)) {
            } else {
                $testValue = strtolower($testValue);
            }

            if (in_array($testValue, $this->false_array) === true || $testValue === false) {
            } else {
                $this->setValidateMessage(1000);
                return false;
            }
        }

        return true;
    }

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === null) {
            return $this->field_value;
        }

        $testValue = $this->field_value;

        if (is_numeric($testValue) || is_bool($testValue)) {
        } else {
            $testValue = strtolower($testValue);
        }

        if (is_bool($testValue) && $testValue === false) {
            return $this->field_value;
        }

        if (count($this->false_array) > 0) {
            foreach ($this->false_array as $item) {
                if ($item === $testValue) {
                    return $this->field_value;
                }
            }
        }

        $this->field_value = null;

        return $this->field_value;
    }

    /**
     * Format
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function format()
    {
        $this->sanitize();

        if ($this->field_value === null) {
        } else {
            $this->field_value = false;
        }

        return $this->field_value;
    }
}
