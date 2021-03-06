<?php
/**
 * Values Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Values Constraint
 *
 * Value (or array of values) must be defined within the $options['valid_values_array'] array.
 *
 * #### Validate
 *
 * Verifies value (or array of values) against constraint, returning a TRUE or FALSE result and error messages
 *
 * In this example, $response->getValidateResponse() is TRUE since `a` is in the array `a`, `b`, `c`.
 *
 * ```php
 * $options = array();
 * $options['valid_values_array'] = array('a', 'b', 'c');
 * $response = $request->validate('random_field', 'a', 'Values', $options);
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
 * Returns null if value (or array of values) is not defined within the $options['valid_values_array'].
 *
 * In this example, $field_value is NULL since `z` is not `a`, `b` or `c`.
 *
 * ```php
 * $options = array();
 * $options['valid_values_array'] = array('a', 'b', 'c');
 * $response = $request->validate('random_field', 'z', 'Values', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Not implemented. Value sent in is returned unchanged.
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Values extends AbstractArrays implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;
}
