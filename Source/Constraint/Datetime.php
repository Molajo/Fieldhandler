<?php
/**
 * Datetime Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Datetime Constraint
 *
 * Must be a valid formatted date.
 *
 * #### Validate
 *
 * Verifies the date according to the format defined in $options['create_from_format'], returning
 *  true if valid or false and error messages if not valid.
 *
 * ```php
 * $options = array();
 * $options['create_from_format'] = 'Y-m-d H:m:s';
 * $response = $request->sanitize('date_field', '2013-12-31 01:01:01', 'Datetime', $options);
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
 * Validates the date and returns null for $field_value if the date does not conform to the constraint.
 *
 * ```php
 * $options = array();
 * $options['create_from_format'] = 'Y-m-d H:m:s';
 * $response = $request->sanitize('date_field', '2013-12-31 01:01:01', 'Datetime', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Formats a date according to the format defined in $options['display_as_format'];
 *
 * ```php
 * $options = array();
 * $options['create_from_format'] = 'Y-m-d H:m:s';
 * $options['display_as_format'] = 'd/m/Y H:m:s';
 * $response = $request->sanitize('date_field', '2013-12-31 01:01:01', 'Datetime', $options);
 *
 * echo $response->getFieldValue();
 *
 * ```
 *
 * @api
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Datetime extends AbstractDatetime implements ConstraintInterface
{
}
