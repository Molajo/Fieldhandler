<?php
/**
 * Alpha Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Alpha Constraint
 *
 * Each character in the alias URL slug must be alphabetic.
 * To allow the 'space character', use the `allow_space_character` $option.
 *
 * **Validate**
 *
 * Verifies value against constraint and provides messages with false test. In this example, the response is `false`
 * due to the number 3 in the value field.
 *
 * ```php
 * $options = array();
 * $options['allow_space_character'] = true;
 * $response = $request->validate('employee_name', 'Pat 3Nelson', 'Alpha', $options);
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
 * **Sanitize**
 *
 * Removes character that does not meet the definition of the constraint. In this example,
 *  `$field_value` will contain `Pat Nelson`. If `allow_space_character` was not enabled, the
 *  `$field_value` would contain `PatNelson`.
 *
 * ```php
 * $options = array();
 * $options['allow_space_character'] = true;
 * $response = $request->sanitize('employee_name', 'Pat 3Nelson', 'Alpha', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * **Format**
 *
 * For this constraint, the `format` method is not implemented and simply returns the value unchanged.
 *
 * @api
 * @link       http://us1.php.net/manual/en/function.ctype-alpha.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Alpha extends AbstractCtype implements ConstraintInterface
{
    /**
     * ctype Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $ctype = 'ctype_alpha';
}
