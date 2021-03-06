<?php
/**
 * Time Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Time Constraint
 *
 * Must be a valid formatted time.
 *
 * #### Valitime
 *
 * Verifies the time according to the format defined in $options['create_from_time_format'], returning
 *  true if valid or false and error messages if not valid.
 *
 * ```php
 * $options = array();
 * $options['create_from_time_format'] = 'H:i:s';
 * $response = $request->sanitize('time_field', '12:30:00', 'time', $options);
 *
 * if ($response->getValitimeResponse() === true) {
 *     // all is well
 * } else {
 *     foreach ($response->getValitimeMessages as $code => $message) {
 *         echo $code . ': ' . $message . '/n';
 *     }
 * }
 *
 * ```
 *
 * #### Sanitize
 *
 * Validate the time and returns null for $field_value if the time does not conform to the constraint.
 *
 * ```php
 * $options = array();
 * $options['create_from_time_format'] = 'Y-m-d';
 * $response = $request->sanitize('time_field', '2013-12-31', 'time', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Formats a time according to the format defined in $options['display_as_time_format'];
 *
 * ```php
 * $options = array();
 * $options['create_from_time_format'] = 'Y-m-d';
 * $options['display_as_time_format'] = 'd/m/Y';
 * $response = $request->sanitize('time_field', '2013-12-31', 'time', $options);
 *
 * echo $response->getFieldValue();
 *
 * ```
 *
 * @api
 * @link       http://us1.php.net/manual/en/function.ctype-cntrl.php
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Time extends AbstractDatetime implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $default_format = 'H:i:s';
}
