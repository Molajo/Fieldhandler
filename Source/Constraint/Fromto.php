<?php
/**
 * Fromto Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Fromto Constraint
 *
 * Ensures the input value is equal to or greater than the value defined in `$options['from']` value
 * and less than or equal to the value defined in `$options['to']` value.
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * ```php
 * $options = array();
 * $options['from'] = 2000;
 * $options['to'] = 2999;
 * $response = $request->validate('employee_id', $employee_id, 'Fromto', $options);
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
 * Sets `$field_value` to null if the value is not equal to or greater than the value defined
 * in `$options['from']` value and less than or equal to the value defined in `$options['to']` value.
 *
 * ```php
 * $options = array();
 * $options['from'] = 2000;
 * $options['to'] = 2999;
 * $response = $request->validate('employee_id', $employee_id, 'Fromto', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * For this constraint, the `format` method is not implemented. The value sent in is not evaluated or changed.
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Fromto extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 8000;

    /**
     * Validation
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {

        if ($this->testMinimum('from')
            && $this->testMaximum('to')
        ) {
            return true;
        }

        return false;
    }
}
