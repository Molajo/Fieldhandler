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
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        if ($this->getArrayValues() === true) {
            return true;
        }

        $this->setValidateMessage(14000);

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
        if ($this->field_value === null) {
        } else {
            if ($this->getArrayValues() === true) {
            } else {
                $this->field_value = null;
            }
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
     * Test Array Entry Keys
     *
     * @param   boolean $filter
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function getArrayValues($filter = false)
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
        $array_values = $this->getOption($type, array());

        if (is_array($array_values) && count($array_values) > 0) {
            return $array_values;
        }

        throw new UnexpectedValueException
        (
            'Fieldhandler Arrays: must provide options entry: ' . $type
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
        $test = true;

        $entries = $this->field_value;

        foreach ($entries as $entry) {

            if (in_array($entry, $array_values)) {

            } else {
                unset ($entry);
                $test = false;
            }
        }

        if ($filter === true) {
            $this->field_value = $entries;
        }

        return $test;
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
