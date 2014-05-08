<?php
/**
 * AbstractMath Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Equal Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractMath extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 8000;

    /**
     * Validate
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        $method = $this->method_type;

        if ($this->$method() === true) {
            return true;
        }

        $this->setValidateMessage($this->message_code);

        return false;
    }

    /**
     * Verify if the values are equal
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function getEqual()
    {
        if ($this->field_value === $this->getOption('equals')) {
            return true;
        }

        return false;
    }

    /**
     * Verify that the values are not equal
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getNotEqual()
    {
        if ($this->field_value === $this->getOption('not_equal')) {
            return false;
        }

        return true;
    }

    /**
     * Verify that the value is less than a supplied value
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getLessthan()
    {
        if ($this->field_value < $this->getOption('less_than')) {
            return true;
        }

        return false;
    }

    /**
     * Verify that the value is less or equal to a supplied value
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getMinimum()
    {
        if ($this->field_value <= $this->getOption('minimum')) {
            return true;
        }

        return false;
    }

    /**
     * Verify that the values are not equal
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getGreaterthan()
    {
        if ($this->field_value > $this->getOption('greater_than')) {
            return true;
        }

        return false;
    }

    /**
     * Verify that the value is greater than or equal to a supplied value
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getMaximum()
    {
        if ($this->getOption('maximum') >= $this->field_value) {
            return true;
        }

        return false;
    }
}
