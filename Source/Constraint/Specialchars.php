<?php
/**
 * Specialchars Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Specialchars Constraint
 *
 * Convert special characters to HTML entities:
 *
 * '&' (ampersand) becomes '&amp;'
 * '"' (double quote) becomes '&quot;' when ENT_NOQUOTES is not set.
 * "'" (single quote) becomes '&#039;' (or &apos;) only when ENT_QUOTES is set.
 * '<' (less than) becomes '&lt;'
 * '>' (greater than) becomes '&gt;'
 *
 * The constraint can be modified using these flags:
 *
 * ```php
 * $options = array();
 * $options[FILTER_FLAG_STRIP_LOW]   = true;  // strip characters with ASCII value below 32
 * $options[FILTER_FLAG_STRIP_HIGH]  = true;  // strip characters with ASCII value above 32
 * $options[FILTER_FLAG_STRIP_LOW]   = true;  // Encode characters with ASCII value above 32
 *
 * ```
 *
 * #### Validate
 *
 * Not implemented (not a helpful test). Returns false.
 *
 * #### Sanitize
 *
 * Convert special characters to HTML entities:
 *
 * ```php
 *
 * $response = $request->validate('text_field', $data_value, 'Specialchars');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Not implemented. The value sent in is returned unchanged.
 *
 * @api
 * @link       http://us1.php.net/manual/en/filter.filters.sanitize.php
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Specialchars extends AbstractFiltervar implements ConstraintInterface
{
    /**
     * Validate Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $validate_filter = null;

    /**
     * Sanitize Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $sanitize_filter = FILTER_SANITIZE_SPECIAL_CHARS;

    /**
     * Constraint Flags
     *
     * @var    array
     * @since  1.0.0
     */
    protected $constraint_allowable_options
        = array(
            FILTER_FLAG_STRIP_LOW,
            FILTER_FLAG_STRIP_HIGH,
            FILTER_FLAG_ENCODE_HIGH
        );

    /**
     * Validate - not implemented for this constraint
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        $this->setValidateMessage(null);

        return false;
    }
}
