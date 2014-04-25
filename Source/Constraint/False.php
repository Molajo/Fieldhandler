<?php
/**
 * False Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * False Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class False extends AbstractConstraint implements ConstraintInterface
{
    /**
     * False array
     *
     * Override in the Request using $options['false_array'] entry.
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $false_array = array(false => false, 0 => 0, 'no' => 'no', 'off' => 'off');

    /**
     * Constructor
     *
     * @param   string $constraint
     * @param   string $method
     * @param   string $field_name
     * @param   mixed  $field_value
     * @param   array  $options
     *
     * @api
     * @since   1.0.0
     */
    public function __construct(
        $constraint,
        $method,
        $field_name,
        $field_value,
        array $options = array()
    ) {
        if (isset($this->options['false_array'])) {
            $this->false_array = $this->options['false_array'];
            unset($this->options['false_array']);
        }

        parent::__construct(
            $constraint,
            $method,
            $field_name,
            $field_value,
            $options
        );
    }

    /**
     * Validate
     *
     * Verifies value is false, 0, 'no', or 'off', responding with true or false and messages
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {

        } else {
            $testValue = $this->field_value;

            if (is_numeric($testValue) || is_bool($testValue)) {
            } else {
                $testValue = strtolower($testValue);
            }

            if (in_array($testValue, $this->false_array) === true || $testValue === false) {
            } else {
                $this->setValidateMessage(1000);
                return false;
            }
        }

        return true;
    }

    /**
     * Sanitize
     *
     * Sets the return value to NULL if it is not false, 0, 'no', or 'off'
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === null) {
            return $this->field_value;
        }

        $testValue = $this->field_value;

        if (is_numeric($testValue) || is_bool($testValue)) {
        } else {
            $testValue = strtolower($testValue);
        }

        if (is_bool($testValue) && $testValue === false) {
            return $this->field_value;
        }

        if (count($this->false_array) > 0) {
            foreach ($this->false_array as $item) {
                if ($item === $testValue) {
                    return $this->field_value;
                }
            }
        }

        $this->field_value = null;

        return $this->field_value;
    }

    /**
     * Format
     *
     * Method not used for the True constraint - value simply returned
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function format()
    {
        return $this->field_value;
    }
}
