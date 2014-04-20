<?php
/**
 * False Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * False Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class False extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate Input
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

            if (in_array($testValue, $this->false_array) === false) {
                $this->setMessage(1000);
                return false;
            }
        }

        return true;
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

            if (in_array($testValue, $this->false_array) === true) {
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
