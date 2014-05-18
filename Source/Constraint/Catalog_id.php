<?php
/**
 * Catalog_id Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Catalog_id Constraint
 *
 * Includes only digits, plus and minus sign.
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * This example returns true.
 *
 * ```php
 * $response = $request->validate('catalog_id_field', 100, 'Catalog_id');
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
 * Removes characters not conforming to the definition of the constraint. In this example,
 *  `$field_value` will result in NULL.
 *
 * ```php
 * $response = $request->sanitize('catalog_id_field', 'AmyStephen@gmail.com', 'Catalog_id');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Not implemented, simply returns the value sent in.
 *
 * @api
 * @link       http://us1.php.net/manual/en/filter.filters.sanitize.php
 * @link       http://us1.php.net/manual/en/filter.filters.validate.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Catalog_id extends Integer implements ConstraintInterface
{

}
