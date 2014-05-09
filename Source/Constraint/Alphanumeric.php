<?php
/**
 * Alphanumeric Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Alphanumeric Constraint
 *
 * Each character in the alias URL slug must be alphanumeric (a letter or a number).
 * To allow the 'space character', use the `allow_space_character` $option.
 *
 * **Validate**
 *
 * Verifies value against constraint and provides messages with false test.
 *
 * ```php
 * $options = array();
 * $options['allow_space_character'] = true;
 * $response = $request->validate('description', '4 dogs and #3 cats', 'Alphanumeric', $options);
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
 *  `$field_value` will contain `4 dogs and 3 cats`.
 *
 * ```php
 * $options = array();
 * $options['allow_space_character'] = true;
 * $response = $request->sanitize('description', '4 dogs and #3 cats', 'Alphanumeric', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * **Format**
 * For this constraint, the `format` method is not implemented and simply returns the value unchanged.
 *
 * @api
 * @link       http://us1.php.net/manual/en/function.ctype-alnum.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Alphanumeric extends AbstractCtype implements ConstraintInterface
{
    /**
     * ctype Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $ctype = 'ctype_alnum';
}
