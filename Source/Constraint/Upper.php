<?php
/**
 * Upper Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Upper Constraint
 *
 * Each character must be an uppercase character.
 * To allow the 'space character', use the `allow_space_character` $option.
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * This example returns false due to the inclusion of non uppercase characters.
 *
 * ```php
 * $options = array();
 * $options['allow_space_character'] = true;
 * $response = $request->validate('upper_field', 'This is upper', 'Upper');
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
 *  `$field_value` will only contain the uppercase letter `T` since no other characters meet
 *  the constraint definition.
 *
 * ```php
 * $options = array();
 * $options['allow_space_character'] = true;
 * $response = $request->sanitize('upper_field', 'This is upper.', 'Upper');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Uppercase all character values.  In this example,
 *  `$field_value` will contain `THIS IS UPPER.`.
 *
 * Note the '.' is still in the text. To remove all non-uppercase characters, `sanitize` first, then `format.`
 *
 * ```php
 * $response = $request->format('upper_field', 'This is upper.', 'Upper');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * @api
 * @link       http://us1.php.net/manual/en/function.ctype-upper.php
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Upper extends AbstractCtype implements ConstraintInterface
{
    /**
     * ctype Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $ctype = 'ctype_upper';

    /**
     * Format - upper case data
     *
     * @api
     * @return  string
     * @since   1.0.0
     */
    public function format()
    {
        return strtoupper($this->field_value);
    }
}
