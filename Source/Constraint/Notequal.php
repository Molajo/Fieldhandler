<?php
/**
 * Notequal Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\ConstraintInterface;

/**
 * Notequal Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Notequal extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === $this->getNotEqual()) {
            $this->setValidateMessage(1000);
            return false;
        }

        return true;
    }

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function sanitize()
    {
        $notEqual = $this->getNotEqual();

        if ($this->field_value === $notEqual) {
            $this->field_value = null;
        }

        return $this->field_value;
    }

    /**
     * Format
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function format()
    {
        return $this->sanitize();
    }

    /**
     * Not equal
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getNotEqual()
    {
        $field_value = $this->getOption('not_equal', null);

        if ($field_value === null) {
            throw new UnexpectedValueException
            (
                'Fieldhandler Notequal: must provide options[not_equal] value.'
            );
        }

        return $field_value;
    }
}
