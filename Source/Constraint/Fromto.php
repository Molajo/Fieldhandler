<?php
/**
 * Fromto Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Fromto Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Fromto extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        $from_to = $this->getFromto();

        if ($this->field_value >= $from_to[0]
            && $this->field_value <= $from_to[1]
        ) {
            return true;
        }

        $this->setValidationMessage(8000);

        return false;
    }

    /**
     * Filter
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function filter()
    {
        if ($this->validate()) {
            return $this->field_value;
        }

        $this->field_value = null;

        return $this->field_value;
    }

    /**
     * Escape
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function escape()
    {
        return $this->filter();
    }

    /**
     * From value and To value
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getFromto()
    {
        $field_value_from = 0;
        $field_value_to   = 999999999999;

        if (isset($this->options['from'])) {
            $field_value_from = $this->options['from'];
        }

        if (isset($this->options['to'])) {
            $field_value_to = $this->options['to'];
        }

        return array($field_value_from, $field_value_to);
    }
}
