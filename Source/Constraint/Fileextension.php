<?php
/**
 * File Extension Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * File Extension
 *
 * Value must conform to one of the values defined within the $file_extension_array.
 *
 * To override, send in an options entry of the values desired:
 *
 * ```php
 *
 * $file_extension_array = array('gif', 'jpeg', 'jpg', 'png', 'pdf', 'odt', 'txt', 'rtf', 'mp3');
 * $options = array();
 * $options{'file_extension_array'] = $file_extension_array;
 *
 * ```
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * ```php
 * $response = $request->validate('file_extension_field', '.pdf', 'Fileextension');
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
 * Returns null if value is not defined within the $file_extension_array.
 *
 * ```php
 * $response = $request->validate('file_extension_field', '.pdf', 'Fileextension');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Not implemented. Value sent in is returned unchanged.
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Fileextension extends AbstractArrays implements ConstraintInterface
{
    /**
     * Valid File Extensions array
     *
     * Override in the Request using $options['file_extension_array'] entry.
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $file_extension_array = array('gif', 'jpeg', 'jpg', 'png', 'pdf', 'odt', 'txt', 'rtf', 'mp3');

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Constructor
     *
     * @param   string $constraint
     * @param   string $method
     * @param   string $field_name
     * @param   mixed  $field_value
     * @param   array  $options
     *
     * @api
     * @since   1.0.0
     */
    public function __construct(
        $constraint,
        $method,
        $field_name,
        $field_value,
        array $options = array()
    ) {
        $options = $this->setPropertyKeyWithOptionKey('file_extension_array', $options);

        $this->getCompareToArrayFromInput('file_extension_array', $this->file_extension_array);

        parent::__construct(
            $constraint,
            $method,
            $field_name,
            $field_value,
            $options
        );
    }
}
