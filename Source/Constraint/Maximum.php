<?php
/**
 * Maximum Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\ConstraintInterface;

/**
 * Maximum Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Maximum extends AbstractConstraint implements ConstraintInterface
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

        } else {

            if ($this->getMaximum() > $this->field_value) {
                return true;
            }
        }

        $this->setValidateMessage(10000);

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

            if ($this->getMaximum() > $this->field_value) {
            } else {
                $this->field_value = $this->getMaximum();
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
        return $this->field_value;
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getMaximum()
    {
        $field_value = '';

        if (isset($this->options['maximum'])) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Maximum: must provide options[maximum] array values.'
            );
        }

        if (isset($this->options['maximum'])) {
            $field_value = $this->options['maximum'];
        }

        return $field_value;
    }
}
