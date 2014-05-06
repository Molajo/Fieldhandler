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
class Arrays extends AbstractArrays implements ConstraintInterface
{
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

        $edits_passed = true;

        if (is_array($this->field_value)) {
        } else {
            $this->setValidateMessage(3000);
            $edits_passed = false;
        }

        if ($this->testValues(false) === false) {
            $this->setValidateMessage(4000);
            $edits_passed = false;
        }

        if ($this->testKeys(false) === false) {
            $this->setValidateMessage(5000);
            $edits_passed = false;
        }

        if ($this->testCount(false) === false) {
            $this->setValidateMessage(6000);
            $edits_passed = false;
        }

        if ($edits_passed === false) {
            return false;
        }

        return true;
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

            if (is_array($this->field_value)) {

            } else {
                $this->field_value = null;
                return $this->field_value;
            }

            $this->testValues(true);
            $this->testKeys(true);
            $this->testCount(true);
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
    protected function testKeys($filter = false)
    {
        return $this->testArrayValues($this->getArrayOptionArray('array_valid_keys'), $filter);
    }

    /**
     * Test Array Entry Values
     *
     * @param   boolean $filter
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testValues($filter = false)
    {
        return $this->testArrayValues($this->getArrayOptionArray('array_valid_values'), $filter);
    }
}
