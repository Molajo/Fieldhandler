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
 * @link       http://php.net/manual/en/function.is-array.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractArrays extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Array Options Entry Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $compare_to_array_option_name;

    /**
     * Array Options Values
     *
     * @var    array
     * @since  1.0.0
     */
    protected $compare_to_array_option_values;

    /**
     * Validation Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $validation_test = 'validation';

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
        if ($this->compare_to_array_option_name === null) {
        } else {
            $this->getCompareToArrayFromOptions($this->compare_to_array_option_name);
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
     * Build Compare To Array using $options Entry
     *
     * @param   string $type
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getCompareToArrayFromOptions($type)
    {
        return $this->getCompareToArrayFromInput($type, $this->getOption($type));
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
    protected function getCompareToArrayFromInput($type, array $compare_to_array = array())
    {
        if (is_array($compare_to_array) && count($compare_to_array) > 0) {
            $this->compare_to_array_option_values = $compare_to_array;

            return $this;
        }

        throw new UnexpectedValueException(
            'Fieldhandler Arrays getCompareToArrayFromInput: invalid empty array for type: ' . $type
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
        if ($this->testInputAgainstValidArray(false) === true) {
            return true;
        }

        return false;
    }

    /**
     * Test Input against Valid Values Array
     *
     * @param   boolean $filter
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testInputAgainstValidArray($filter)
    {
        if (is_array($this->field_value)) {
        } else {
            return $this->testStringInputAgainstValidArray();
        }

        $validated_input_array = $this->testArrayInputAgainstValidArray();

        if (count($validated_input_array) === count($this->field_value)) {
            $valid = true;

        } else {
            $valid = false;
            if ($filter === true) {
                $this->field_value = $validated_input_array;
                $valid             = true;
            }
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

        foreach ($this->compare_to_array_option_values as $valid) {

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
        $new = array();

        foreach ($this->field_value as $entry) {

            if (in_array($entry, $this->compare_to_array_option_values) === false) {
            } else {
                $new[] = $entry;
            }
        }

        return $new;
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
