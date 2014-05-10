<?php
/**
 * Nothing Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Nothing Constraint
 *
 * Value must conform to one of the values defined within the $valid_values_array.
 *
 * To override, send in an options entry of the values desired:
 *
 * ```php
 *
 * $valid_values_array = array(false, 0, ' ', null);
 * $options = array();
 * $options['valid_values_array'] = $valid_values_array;
 *
 * ```
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * ```php
 * $response = $request->validate('random_field', $value, 'Nothing');
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
 * Returns null if value is not defined within the $valid_values_array.
 *
 * ```php
 * $response = $request->validate('random_field', $value, 'Nothing');
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
 * @api
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Nothing extends AbstractArrays implements ConstraintInterface
{
    /**
     * Nothing array
     *
     * Override in the Request using $options['valid_values_array'] entry.
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $valid_values_array = array(false, 0, ' ', null);

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;
}
