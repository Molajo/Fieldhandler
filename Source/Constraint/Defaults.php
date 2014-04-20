<?php
/**
 * Defaults Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Defaults Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Defaults extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        $this->setDefault();

        if ($this->field_value === null) {
            $this->setValidationMessage(7000);
            return false;
        }

        return true;
    }

    /**
     * Filter
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function filter()
    {
        $this->setDefault();

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
     * If needed, apply default to Field
     *
     * @return  $this
     * @since   1.0.0
     */
    protected function setDefault()
    {
        if ($this->field_value === null) {

            $default = null;

            if (isset($this->options['default'])) {
                $default = $this->options['default'];
            }

            if ($default === null) {
            } else {
                $this->field_value = $default;
            }
        }

        return $this;
    }
}
