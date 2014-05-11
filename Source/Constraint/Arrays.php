<?php
/**
 * Array Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Arrays Constraint
 *
 * Must be an array.
 * Optionally, if $options['valid_values_array'] is provided, array values must match a value in the valid array.
 * Optionally, if $options['array_minimum'] is specified, array entries must not be less than that value.
 * Optionally, if $options['array_maximum'] is specified, array entries must not be exceed that value.
 *
 * #### Validate
 *
 * Verifies value (or array of values) against constraint, returning a TRUE or FALSE result and error messages
 *
 * In this example, $response->getValidateResponse() is TRUE since `b` and `c` are in the
 * valid array of `a`, `b`, `c` and because there are two entries in the input array which is more than
 * the minimum value allowed of 1.
 *
 * ```php
 * $options = array();
 * $options['valid_values_array'] = array('a', 'b', 'c');
 * $options['array_minimum'] = 1;
 * $response = $request->validate('array_field', array('b', 'c'), 'Array', $options);
 *
 * if ($response->getValidateResponse() === true) {
 *     // all is well
 * } else {
 *     foreach ($response->getValidateMessages as $code => $message) {
 *         echo $code . ': ' . $message . '/n';
 *     }
 * }
 *
 * ```
 *
 * #### Sanitize
 *
 * Returns null if the array does not meet the constraint definition.
 *
 * In this example, $field_value is NULL since `b` and `c` are not in the valid array values.
 *
 * ```php
 * $options = array();
 * $options['valid_values_array'] = array('x', 'y', 'z');
 * $response = $request->validate('array_field', array('b', 'c'), 'Array', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Not implemented. Value sent in is returned unchanged.
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Arrays extends AbstractArrays implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 3000;

    /**
     * Validation Testing
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        $validation_array = array(
            'testIsArray' => 3000,
            'testValues'  => 4000,
            'testCount'   => 6000,
        );

        $test = true;

        foreach ($validation_array as $key => $value) {
            if ($this->runValidationTest($key, $value) === false) {
                $test = false;
                break;
            }
        }

        return $test;
    }

    /**
     * Run the validation Test
     *
     * @param   string $method
     * @param   string $message_code
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function runValidationTest($method, $message_code)
    {
        if ($this->$method(false) === false) {
            $this->message_code = $message_code;

            return false;
        }

        return true;
    }

    /**
     * Test Array Entry Keys
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testIsArray()
    {
        if (is_array($this->field_value)) {
        } else {
            $this->message_code = 3000;

            return false;
        }

        return true;
    }

    /**
     * Test Array Values to Valid Values
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testValues()
    {
        if (count($this->valid_values_array) > 0) {
            return $this->testInputAgainstValidArray();
        }

        return true;
    }
}
