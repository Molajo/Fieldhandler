<?php
/**
 * Printable Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Printable Constraint
 *
 * Each character must be a printable character.
 *
 * **Validate**
 *
 * Verifies value against constraint and provides messages with false test.
 *
 * This example returns false due to the inclusion of control characters which cannot be displayed.
 *
 * ```php
 * $response = $request->validate('printable_field', 'asdf\n\r\t', 'Printable');
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
 * Removes characters not conforming to the definition of the constraint. In this example,
 *  `$field_value` will contain `asdf`.
 *
 * ```php
 * $response = $request->sanitize('printable_field', 'asdf\n\r\t', 'Printable');
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
 * @link       http://us1.php.net/manual/en/function.ctype-print.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Printable extends AbstractCtype implements ConstraintInterface
{
    /**
     * ctype Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $ctype = 'ctype_print';
}
