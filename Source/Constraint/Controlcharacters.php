<?php
/**
 * Controlcharacters Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Control Characters Constraint
 *
 * Each character must be a control character (ex. line feed, tab, escape).
 * To allow the 'space character', use the `allow_space_character` $option.
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * ```php
 * $options = array();
 * $options['allow_space_character'] = true;
 * $response = $request->validate('text_field', '\n \r \t', 'Controlcharacters', $options);
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
 *  `$field_value` will contain `\n \r \t`.
 *
 * ```php
 * $options = array();
 * $options['allow_space_character'] = true;
 * $response = $request->sanitize('text_field', 'N\n \r \t', 'Alpha', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * For this constraint, the `format` method is not implemented. The value sent in is not evaluated or changed.
 *
 * @api
 * @link       http://us1.php.net/manual/en/function.ctype-cntrl.php
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Controlcharacters extends AbstractCtype implements ConstraintInterface
{
    /**
     * ctype Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $ctype = 'ctype_cntrl';
}
