<?php
/**
 * Required Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Required Constraint
 *
 * Value must not be a null value.
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * ```php
 * $response = $request->validate('random_field', $value, 'Required');
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
 * Not useful. (Can only return a NULL value if it is NULL.)
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
class Required extends AbstractOpposite implements ConstraintInterface
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
     * Copy of Null array
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $valid_values_array = array(null);
}
