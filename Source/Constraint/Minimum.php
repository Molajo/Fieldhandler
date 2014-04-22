<?php
/**
 * Minimum Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Minimum Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Minimum extends AbstractConstraint implements ConstraintInterface
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

        if ($this->field_value > $this->getMinimum()) {
            $this->setValidateMessage(11000);
            return false;
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
        } else {

            if ($this->field_value > $this->getMinimum()) {
                $this->field_value = $this->getMinimum();
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
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getMinimum()
    {
        $field_value = '';

        if (isset($this->options['minimum'])) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Minimum: must provide options[minimum] array values.'
            );
        }

        if (isset($this->options['minimum'])) {
            $field_value = $this->options['minimum'];
        }

        return $field_value;
    }
}
