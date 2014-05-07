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
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 3000;

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === NULL) {
            return $this->field_value;
        }

        if (is_array($this->field_value)) {

        } else {
            $this->field_value = NULL;

            return $this->field_value;
        }

        $this->testValues(TRUE);
        $this->testKeys(TRUE);
        $this->testCount(TRUE);

        return $this->field_value;
    }

    /**
     * Validation Testing
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if (is_array($this->field_value)) {
        } else {
            $this->message_code = 3000;
            return FALSE;
        }

        if ($this->testValues(FALSE) === FALSE) {
            $this->message_code = 4000;
            return FALSE;
        }

        if ($this->testKeys(FALSE) === FALSE) {
            $this->message_code = 5000;
            return FALSE;
        }

        if ($this->testCount(FALSE) === FALSE) {
            $this->message_code = 6000;
            return FALSE;
        }

        return TRUE;
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
