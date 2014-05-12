<?php
/**
 * Minimum Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Minimum Constraint
 *
 * Ensures the input value is greater than or equal to the value defined in `$options['minimum']` value.
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * ```php
 * $options = array();
 * $options['minimum'] = 1000;
 * $response = $request->validate('employee_id', $employee_id, 'Minimum', $options);
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
 * Sets `$field_value` to null if the value is not less than or equal to the value defined
 * in `$options['minimum']` value.
 *
 * ```php
 * $options = array();
 * $options['minimum'] = 1000;
 * $response = $request->validate('employee_id', $employee_id, 'Minimum', $options);
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
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Minimum extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Verify if the input value is less than or equal to comparison value
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        return $this->testMinimum('minimum');
    }
}
