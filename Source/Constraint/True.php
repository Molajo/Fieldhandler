<?php
/**
 * True Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * True Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class True extends AbstractConstraint implements ConstraintInterface
{
    /**
     * True array
     *
     * Override in the Request using $options['true_array'] entry.
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $true_array = array(true => true, 1 => 1, 'yes' => 'yes', 'on' => 'on');

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
        if (isset($this->options['true_array'])) {
            $this->true_array = $this->options['true_array'];
            unset($this->options['true_array']);
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
     * Verifies value is true, 1, 'yes', or 'on', responding with true or false and messages
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

            if (in_array($testValue, $this->true_array) === false) {
                $this->setValidateMessage(1000);
                return false;
            }
        }

        return true;
    }

    /**
     * Sanitize
     *
     * Sets the return value to NULL if it is not true, 1, 'yes', or 'on.'
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === null) {

        } else {
            $testValue = $this->field_value;

            if (is_numeric($testValue) || is_bool($testValue)) {
            } else {
                $testValue = strtolower($testValue);
            }

            if (in_array($testValue, $this->true_array) === true) {
            } else {
                $this->field_value = null;
            }
        }

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
