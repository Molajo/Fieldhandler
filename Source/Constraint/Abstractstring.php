<?php
/**
 * Abstractstring Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Abstractstring Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Abstractstring extends AbstractConstraint implements ConstraintInterface
{
    /**
     * String Function
     *
     * @var    string
     * @since  1.0.0
     */
    protected $string_function;

    /**
     * Validate
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        $temp = $this->doStringFunction();

        if ($temp === $this->field_value) {
            $this->setValidateMessage(2000);
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
            return $this->field_value;
        }

        $temp = $this->doStringFunction();

        if ($this->field_value === $temp) {
        } else {
            $this->field_value = null;
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
        return $this->doStringFunction();
    }

    /**
     * Format
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function doStringFunction()
    {
        if ($this->string_function === 'trim') {
            return trim($this->field_value);
        } elseif ($this->string_function === 'lower') {
            return strtolower($this->field_value);
        } elseif ($this->string_function === 'upper') {
            return strtoupper($this->field_value);
        }
    }
}
