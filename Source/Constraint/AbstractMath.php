<?php
/**
 * AbstractMath Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\ConstraintInterface;

/**
 * Equal Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractMath extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Method Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $method_type;

    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->$this->method_type() === true) {
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
        if ($this->$this->method_type() === true) {
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
        return parent::format();
    }

    /**
     * Verify if the values are equal
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function getEqual()
    {
        return $this->performMathCompare('equal');
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
        return $this->performMathCompare('not_equal');
    }

    /**
     * Verify that the value is less than a supplied value
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getLessthan()
    {
        return $this->performMathCompare('less_than');
    }

    /**
     * Verify that the value is less or equal to a supplied value
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getMinimum()
    {
        return $this->performMathCompare('minimum');
    }

    /**
     * Verify that the values are not equal
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getGreaterthan()
    {
        return $this->performMathCompare('greater_than');
    }

    /**
     * Verify that the value is greater than or equal to a supplied value
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getMaximum()
    {
        return $this->performMathCompare('maximum');
    }

    /**
     * Verify that the values are not equal
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function performMathCompare($type)
    {
        $compare_to_value = $this->getMathOptionValue($type);

        $comparison = false;

        switch ($type) {
            case 'equal':
                if ($this->field_value === $compare_to_value) {
                    $comparison = true;
                }
                break;

            case 'not_equal':
                if ($this->field_value <> $compare_to_value) {
                    $comparison = true;
                }
                break;

            case 'less_than':
                if ($this->field_value < $compare_to_value) {
                    $comparison = true;
                }
                break;

            case 'minimum':
                if ($this->field_value <= $compare_to_value) {
                    $comparison = true;
                }
                break;

            case 'greater_than':
                if ($this->field_value > $compare_to_value) {
                    $comparison = true;
                }
                break;

            case 'maximum':
                if ($this->field_value >= $compare_to_value) {
                    $comparison = true;
                }
                break;
        }

        return $comparison;
    }

    /**
     * Verify if the values are equal
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getMathOptionValue($field)
    {
        $field_value = $this->getOption($field);

        if ($field_value === null) {
            throw new UnexpectedValueException
            (
                'Fieldhandler AbstractMath: must provide options entry: ' . $field
            );
        }

        return $field_value;
    }
}
