<?php
/**
 * Array Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\ConstraintInterface;

/**
 * Arrays Constraint
 *
 * Must be an array.
 * Optionally, must have keys which match array keys defined in $options['valid_values_array'];
 * Optionally, must have values which match array values defined in $options['valid_values_array'];
 * Optionally, must not have fewer entries than are defined in $options['array_minimum'];
 * Optionally, must not have more entries than are defined in $options['array_maximum'];
 *
 * #### Validate
 *
 * Verifies value (or array of values) against constraint, returning a TRUE or FALSE result and error messages
 *
 * In this example, $response->getValidateResponse() is TRUE since `a` is in the array `a`, `b`, `c`.
 *
 * ```php
 * $options = array();
 * $options['valid_values_array'] = array('a', 'b', 'c');
 * $response = $request->validate('random_field', 'a', 'Values', $options);
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
 * Returns null if value (or array of values) is not defined within the $options['valid_values_array'].
 *
 * In this example, $field_value is NULL since `z` is not `a`, `b` or `c`.
 *
 * ```php
 * $options = array();
 * $options['valid_values_array'] = array('a', 'b', 'c');
 * $response = $request->validate('random_field', 'z', 'Values', $options);
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
 * @link       http://php.net/manual/en/function.is-array.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractArrays extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Array Options Values
     *
     * @var    array
     * @since  1.0.0
     */
    protected $valid_values_array;

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 3000;

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
        parent::__construct(
            $constraint,
            $method,
            $field_name,
            $field_value,
            $options
        );

        $this->getCompareToArrayFromOptions();
    }

    /**
     * Build Compare To Array using $options Entry
     *
     * @param   string $type
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getCompareToArrayFromOptions()
    {
        $array = $this->getOption('valid_values_array');

        if (count($array) > 0) {
            return $this->getCompareToArrayFromInput($array);
        }

        // $this->valid_values_array property can be defined in sub class

        return $this;
    }

    /**
     * Build Compare To Array from Array Input
     *
     * @param   array $compare_to_array
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getCompareToArrayFromInput(array $compare_to_array = array())
    {
        if (is_array($compare_to_array) && count($compare_to_array) > 0) {
            $this->valid_values_array = $compare_to_array;

            return $this;
        }

        throw new UnexpectedValueException(
            'Fieldhandler Arrays getCompareToArrayFromInput: invalid empty array'
        );
    }

    /**
     * Validation Test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if ($this->testInputAgainstValidArray() === true) {
            return true;
        }

        return false;
    }

    /**
     * Test Input against Valid Values Array
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testInputAgainstValidArray()
    {
        if (is_array($this->field_value)) {
        } else {
            return $this->testStringInputAgainstValidArray();
        }

        $hold_count = count($this->field_value);

        $this->testArrayInputAgainstValidArray();

        if ($hold_count === count($this->field_value)) {
            $valid = true;
        } else {
            $valid = false;
        }

        return $valid;
    }

    /**
     * Verify single value input to valid array
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testStringInputAgainstValidArray()
    {
        $matched = false;

        foreach ($this->valid_values_array as $valid) {

            if ($this->field_value === $valid) {
                $matched = true;
                break;
            }
        }

        return $matched;
    }

    /**
     * Verify input array only has entries that are defined by the valid array
     *
     * @return  array
     * @since   1.0.0
     */
    protected function testArrayInputAgainstValidArray()
    {
        $validated_input_array = array();

        foreach ($this->field_value as $entry) {

            if (in_array($entry, $this->valid_values_array) === false) {
            } else {
                $validated_input_array[] = $entry;
            }
        }

        $this->field_value = $validated_input_array;

        return $this;
    }

    /**
     * Test Array Entry Values
     *
     * @param   boolean $filter
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testCount($filter = false)
    {
        $array_minimum = $this->getOption('array_minimum', 0);
        $array_maximum = $this->getOption('array_maximum', 9999999999);

        if (count($this->field_value) < $array_minimum
            || count($this->field_value) > $array_maximum
        ) {

            if ($filter === true) {
                $this->field_value = null;
            }

            return false;
        }

        return true;
    }
}
