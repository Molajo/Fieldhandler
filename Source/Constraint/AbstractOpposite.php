<?php
/**
 * AbstractOpposite Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * AbstractOpposite Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
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
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validateResponseArray()
    {
        $hold_array = $this->field_value;

        $results = parent::validate();

        if ($results == true
            || count($hold_array) === 0
            || count($this->field_value) === 0
        ) {
            $this->field_value       = $hold_array;
            $this->validate_messages = null;

            return true;
        }

        $new_array = array();
        foreach ($hold_array as $value) {
            if (in_array($value, $this->field_value)) {
            } else {
                $new_array[] = $value;
            }
        }

        $this->field_value = $new_array;

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
