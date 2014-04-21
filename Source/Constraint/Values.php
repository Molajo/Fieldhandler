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
     * Handle Input
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function handleInput()
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
     * Test Array Entry Values
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException;
     */
    public function getFieldValues()
    {
        $field_values = array();

        if (isset($this->options['array_valid_values'])) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Values: must provide options[array_valid_values] values.'
            );
        }

        if (isset($this->options['array_valid_values'])) {
            $field_values = $this->options['array_valid_values'];
        }

        return $field_values;
    }
}
