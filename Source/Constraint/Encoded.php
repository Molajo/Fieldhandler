<?php
/**
 * Encoded Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Encoded Constraint
 *
 * URL-encode string, optionally strip or encode special characters.
 *
 * The following flags can be applied by adding to the options array (see examples):
 *
 * ```php
 *
 * $options = array();
 * $options[FILTER_FLAG_STRIP_LOW] = true;
 * $options[FILTER_FLAG_STRIP_HIGH] = true;
 * $options[FILTER_FLAG_ENCODE_LOW] = true;
 * $options[FILTER_FLAG_ENCODE_HIGH] = true;
 *
 * ```
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages.
 * For Encoded, the original value is compared to a sanitized value. If those values match,
 * true is returned. Otherwise, the response is false and an error message is available.
 *
 * ```php
 * $response = $request->validate('encode_field', 'AmyStephen@gmail.com', 'Encode');
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
 * Removes characters not conforming to the definition of the constraint.
 *
 * In this example, the input URL is `something.php?text=unknown values here`.
 * The resulting value is `unknown%20values%20here`.
 *
 * ```php
 * $response = $request->sanitize('encode_field', 'unknown values here', 'Encode');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Format is not implemented for this constraint.
 *
 * @api
 * @link       http://us1.php.net/manual/en/filter.filters.sanitize.php
 * @link       http://us1.php.net/manual/en/filter.filters.validate.php
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Encoded extends AbstractFiltervar implements ConstraintInterface
{
    /**
     * Validate Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $validate_filter = null;

    /**
     * Sanitize Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $sanitize_filter = FILTER_SANITIZE_ENCODED;

    /**
     * Constraint Flags
     *
     * To enable flags for use with the request, add the flags to the options array
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $constraint_allowable_options
        = array(
            FILTER_FLAG_STRIP_HIGH,
            FILTER_FLAG_STRIP_LOW,
            FILTER_FLAG_ENCODE_HIGH,
            FILTER_FLAG_ENCODE_LOW
        );
}
