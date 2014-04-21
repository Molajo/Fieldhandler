<?php
/**
 * True Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * True Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class True extends AbstractConstraint implements ConstraintInterface
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

            if (in_array($testValue, $this->true_array) === false) {
                $this->setValidateMessage(1000);
                return false;
            }
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
            $testValue = $this->field_value;

            if (is_numeric($testValue) || is_bool($testValue)) {
            } else {
                $testValue = strtolower($testValue);
            }

            if (in_array($testValue, $this->true_array) === true) {
            } else {
                $this->field_value = null;
            }
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
}
