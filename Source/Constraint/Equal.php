<?php
/**
 * Equal Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\ConstraintInterface;

/**
 * Equal Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Equal extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === $this->getEqual()) {
            return true;
        }

        $this->setValidateMessage(8000);

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
        if ($this->field_value === $this->getEqual()) {
        } else {
            $this->field_value = null;
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
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getEqual()
    {
        $field_value = null;

        if (isset($this->options['equals'])) {
            $field_value = $this->options['equals'];
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Equal: must provide options[equals] value.'
            );
        }

        return $field_value;
    }
}
