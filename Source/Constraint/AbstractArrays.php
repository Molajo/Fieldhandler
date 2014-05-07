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
abstract class AbstractArrays extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Array Options Entry Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $array_option_type;

    /**
     * Method Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $method_test = 'getArrayValues';

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 3000;

    /**
     * Validation Test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if ($this->getArrayValues(FALSE) === TRUE) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Test Array Entry Keys
     *
     * @param   boolean $filter
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function getArrayValues($filter = FALSE)
    {
        return $this->testArrayValues($this->getArrayOptionArray($this->array_option_type), $filter);
    }

    /**
     * Test Array Entry Values
     *
     * @param   string $type
     *
     * @return  array
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getArrayOptionArray($type)
    {
        $array_values = $this->getOption($type);

        if (is_array($array_values) && count($array_values) > 0) {
            return $array_values;
        }

        throw new UnexpectedValueException
        (
            'Fieldhandler Arrays: must provide entry with array in options: ' . $type
        );
    }

    /**
     * Test Array Values
     *
     * @param   array   $array_values
     * @param   boolean $filter
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testArrayValues($array_values, $filter)
    {
        $tested = $this->testArrayValuesPart($array_values);

        if (count($tested) === count($this->field_value)) {
            $test = TRUE;

        } else {
            $test = FALSE;
            if ($filter === TRUE) {
                $this->field_value = $tested;
            }
        }

        return $test;
    }

    /**
     * Test Array Values returning only good entries
     *
     * @param   array   $array_values
     *
     * @return  array
     * @since   1.0.0
     */
    protected function testArrayValuesPart($array_values)
    {
        $new = array();

        foreach ($this->field_value as $entry) {

            if (in_array($entry, $array_values) === FALSE) {
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
    protected function testCount($filter = FALSE)
    {
        $array_minimum = $this->getOption('array_minimum', 0);
        $array_maximum = $this->getOption('array_maximum', 9999999999);

        if (count($this->field_value) < $array_minimum
            || count($this->field_value) > $array_maximum
        ) {

            if ($filter === TRUE) {
                $this->field_value = NULL;
            }

            return FALSE;
        }

        return TRUE;
    }
}
