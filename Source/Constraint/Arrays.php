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
        if ($this->field_value === NULL) {
            return TRUE;
        }

        $edits_passed = TRUE;

        if (is_array($this->field_value)) {
        } else {
            $this->setValidateMessage(3000);
            $edits_passed = FALSE;
        }

        if ($this->testValues(FALSE) === FALSE) {
            $this->setValidateMessage(4000);
            $edits_passed = FALSE;
        }

        if ($this->testKeys(FALSE) === FALSE) {
            $this->setValidateMessage(5000);
            $edits_passed = FALSE;
        }

        if ($this->testCount(FALSE) === FALSE) {
            $this->setValidateMessage(6000);
            $edits_passed = FALSE;
        }

        if ($edits_passed === FALSE) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === NULL) {
        } else {

            if (is_array($this->field_value)) {

            } else {
                $this->field_value = NULL;

                return $this->field_value;
            }

            $this->testValues(TRUE);
            $this->testKeys(TRUE);
            $this->testCount(TRUE);
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
    protected function testKeys($filter = FALSE)
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
    protected function testValues($filter = FALSE)
    {
        return $this->testArrayValues($this->getArrayOptionArray('array_valid_values'), $filter);
    }
}
