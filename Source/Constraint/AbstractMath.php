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
class AbstractMath extends AbstractConstraint implements ConstraintInterface
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
        $compare_to_value = $this->getOption('equals', null);

        if ($compare_to_value === $this->field_value) {
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
        $compare_to_value = $this->getOption('not_equal', null);

        if ($compare_to_value === $this->field_value) {
            return false;
        }

        return true;
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
        $compare_to_value = $this->getMathOptionValue('less_than');

        if ($this->field_value < $compare_to_value) {
            return true;
        }

        return false;
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
        $compare_to_value = $this->getMathOptionValue('greater_than');

        if ($this->field_value > $compare_to_value) {
            return true;
        }

        return false;
    }
    /**
     * Verify if the values are equal
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getMathOptionValue($field)
    {
        $field_value = $this->getOption($field, null);
        $field_value = $this->getMathOptionValue('greater_than');

        if ($field_value === null) {
            throw new UnexpectedValueException
            (
                'Fieldhandler AbstractMath: must provide options entry: ' . $field
            );
        }

        return $field_value;
    }
}
