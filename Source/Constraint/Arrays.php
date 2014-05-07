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
        if ($this->field_value === null) {
            return $this->field_value;
        }

        if (is_array($this->field_value)) {

        } else {
            $this->field_value = null;

            return $this->field_value;
        }

        $this->testValues(true);
        $this->testKeys(true);
        $this->testCount(true);

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
        $validation_array = array(
            'isArray'    => 3000,
            'testValues' => 4000,
            'testKeys'   => 5000,
            'testCount'  => 6000,
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
