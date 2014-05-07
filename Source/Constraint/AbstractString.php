<?php
/**
 * AbstractString Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * AbstractString Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractString extends AbstractConstraint implements ConstraintInterface
{
    /**
     * String Function
     *
     * @var    string
     * @since  1.0.0
     */
    protected $string_function;

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 2000;

    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        return parent::validate();
    }

    /**
     * Sanitize
     *
     * @return  null|string
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === NULL) {
            return $this->field_value;
        }

        $temp = $this->doStringFunction();

        if ($this->field_value === $temp) {
        } else {
            $this->field_value = NULL;
        }

        return $this->field_value;
    }

    /**
     * Format
     *
     * @return  string|null
     * @since   1.0.0
     */
    public function format()
    {
        return $this->doStringFunction();
    }

    /**
     * Validation Test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        $temp = $this->doStringFunction();

        if ($temp === $this->field_value) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Format
     *
     * @return  string|null
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

        return $this->field_value;
    }
}
