<?php
/**
 * Tel Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Tel Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Tel extends AbstractConstraint implements ConstraintInterface
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

        if (filter_var($this->field_value, FILTER_SANITIZE_STRING, $this->setFlags())) {
            return true;
        }

        $this->setValidationMessage(1000);

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
        if ($this->field_value === null) {
        } else {
            $this->field_value = filter_var($this->field_value, FILTER_SANITIZE_STRING, $this->setFlags());
        }

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
        $this->filter();

        /** TODO: Apply localisation mask */
        $temp = '1 (' . substr($this->field_value, 0, 3)
            . ') ' . substr($this->field_value, 0, 3)
            . '-' . substr($this->field_value, 0, 4);
    }
}
