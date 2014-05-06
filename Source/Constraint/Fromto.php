<?php
/**
 * Fromto Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Fromto Constraint
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

        $this->setValidateMessage(8000);

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
        if ($this->validate()) {
            return $this->field_value;
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
        return parent::format();
    }

    /**
     * From value and To value
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getFromto()
    {
        $field_value_from = $this->getOption('from', 0);
        $field_value_to   = $this->getOption('to', 999999999999);

        return array($field_value_from, $field_value_to);
    }
}
