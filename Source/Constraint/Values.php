<?php
/**
 * Values Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\ConstraintInterface;

/**
 * Values Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Values extends AbstractConstraint implements ConstraintInterface
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

        if (in_array($this->field_value, $this->getFieldValues())) {
            return true;
        }

        $this->setValidateMessage(14000);

        return false;
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
        } else {
            if (in_array($this->field_value, $this->getFieldValues())) {
            } else {
                $this->field_value = null;
            }
        }

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
        return $this->sanitize();
    }

    /**
     * Test Array Entry Values
     *
     * @return  array
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException;
     */
    public function getFieldValues()
    {
        $array_valid_values = $this->getOption('array_valid_values', array());

        if (is_array($array_valid_values)
            && count($array_valid_values) > 0
        ) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Values: must provide options[array_valid_values] values.'
            );
        }

        return $array_valid_values;
    }
}
