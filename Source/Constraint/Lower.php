<?php
/**
 * Lower Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Lower Constraint
 *
 * Each character must be an lowercase character.
 * To allow the 'space character', use the `allow_space_character` $option.
 *
 * **Validate**
 *
 * Verifies value against constraint and provides messages with false test.
 *
 * This example returns false due to the inclusion of non lowercase characters.
 *
 * ```php
 * $options = array();
 * $options['allow_space_character'] = true;
 * $response = $request->validate('lower_field', 'This is lower', 'Lower');
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
 *  `$field_value` will only contain the lowercase letter `his is lower` since the `T` is uppercased.
 *
 * ```php
 * $options = array();
 * $options['allow_space_character'] = true;
 * $response = $request->sanitize('lower_field', 'This is lower', 'Lower');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * **Format**
 *
 * Lowercase all character values.  In this example,
 *  `$field_value` will contain `this is lower.`.
 *
 * Note the '.' is still in the text. To remove all non-lowercase characters, `sanitize` first, then `format.`
 *
 * ```php
 * $response = $request->format('lower_field', 'This is lower.', 'Lower');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * @api
 * @link       http://us1.php.net/manual/en/function.ctype-lower.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Lower extends AbstractCtype implements ConstraintInterface
{
    /**
     * ctype Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $ctype = 'ctype_lower';

    /**
     * Format - lower case data
     *
     * @api
     * @return  string
     * @since   1.0.0
     */
    public function format()
    {
        return strtolower($this->field_value);
    }
}
