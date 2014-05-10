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
     * Array Options Entry Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $compare_to_array_option_name = 'valid_array';

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
            'testIsArray'    => 3000,
            'testValues'     => 4000,
            'testCount'      => 6000,
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
        if (count($this->compare_to_array_option_values) > 0) {
            return $this->testInputAgainstValidArray(false);
        }

        return true;
    }
}
