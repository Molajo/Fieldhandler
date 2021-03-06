<?php
/**
 * AbstractOpposite Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * AbstractOpposite Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractOpposite extends AbstractArrays implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Validate - testing for a set of values that are NOT desired - reverse results
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        if (is_array($this->field_value)) {
            return $this->validateResponseArray();
        }

        $results = parent::validate();

        if ($results == false) {
            $this->validate_messages = array();
            return true;
        }

        $this->setValidateMessage($this->message_code);

        return false;
    }

    /**
     * Manage the validate response for input that is an array
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validateResponseArray()
    {
        $original_array = $this->field_value;

        $validation_results = parent::validate();

        $valid = $this->validateResponseArrayTrue($validation_results, $original_array);

        if ($valid == true) {
            return $valid;
        }

        return $this->validateResponseArrayFalse($original_array);
    }

    /**
     * Validation True Logic
     *
     * @param boolean $validation_results
     *
     * @return  boolean  $validation_results
     * @return  array    $original_array
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validateResponseArrayTrue($validation_results, $original_array)
    {
        if ($validation_results == true
            || count($original_array) === 0
            || count($this->field_value) === 0
        ) {
            $this->field_value       = $original_array;
            $this->validate_messages = null;

            return true;
        }

        return false;
    }

    /**
     * Validation False Logic
     *
     * @return  boolean  $original_array
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validateResponseArrayFalse($original_array)
    {
        $this->field_value = $this->createFieldValueArrayComparison(
            $original_array,
            $this->field_value,
            false
        );

        $this->setValidateMessage($this->message_code);

        return false;
    }

    /**
     * Sanitize - testing for a set of values that are NOT desired - reverse results
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function sanitize()
    {
        if (is_array($this->field_value)) {
            $this->validate();

            return $this->field_value;
        }

        $hold = $this->field_value;

        parent::sanitize();

        if ($this->field_value === null) {
            $this->field_value = $hold;
        } else {
            $this->field_value = null;
        }

        return $this->field_value;
    }
}
