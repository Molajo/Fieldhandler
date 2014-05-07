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
abstract class AbstractString extends AbstractConstraintTests implements ConstraintInterface
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
     * @return  string
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
            return true;
        }

        return false;
    }

    /**
     * String Functions
     *
     * @return  string
     * @since   1.0.0
     */
    protected function doStringFunction()
    {
        $method = 'do' . ucfirst(strtolower($this->string_function));

        return $this->$method();
    }

    /**
     * Trim String Function
     *
     * @return  string
     * @since   1.0.0
     */
    protected function doTrim()
    {
        return trim($this->field_value);
    }

    /**
     * Lower case String Function
     *
     * @return  string
     * @since   1.0.0
     */
    protected function doLower()
    {
        return strtolower($this->field_value);
    }

    /**
     * Upper case String Function
     *
     * @return  string
     * @since   1.0.0
     */
    protected function doUpper()
    {
        return strtoupper($this->field_value);
    }
}
