<?php
/**
 * Null Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Null Constraint
 *
 * Value must be null.
 *
 * #### Validate
 *
 * Verifies that value is NULL.
 *
 * ```php
 * $response = $request->validate('Null_only_field', $value, 'Null');
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
 * Returns null if value is not not null. =)
 *
 * ```php
 * $response = $request->validate('Null_only_field', $value, 'Null');
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
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Null extends AbstractArrays implements ConstraintInterface
{
    /**
     * Ignore Null
     *
     * @api
     * @var    boolean
     * @since  1.0.0
     */
    protected $ignore_null = false;

    /**
     * Null array
     *
     * Override in the Request using $options['valid_values_array'] entry.
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $valid_values_array = array(null);

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;
}
