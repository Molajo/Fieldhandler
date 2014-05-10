<?php
/**
 * Mimetypes Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Mimetypes
 *
 * Value must conform to one of the values defined within the $mimetype_array.
 *
 * To override, send in an options entry of the values desired:
 *
 * ```php
 *
 * $mimetype_array = array(
 *         'image/gif',
 *         'image/jpeg',
 *         'image/png',
 *         'application/pdf',
 *         'application/odt',
 *         'text/plain',
 *         'text/rtf'
 * );
 * $options = array();
 * $options{'mimetype_array'] = $mimetype_array;
 *
 * ```
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * ```php
 * $response = $request->validate('Mimetype', 'application/pdf', 'Mimetypes');
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
 * Returns null if value is not defined within the $mimetype_array.
 *
 * ```php
 * $response = $request->validate('mimetype_field', 'application/pdf', 'Mimetypes');
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
class Mimetypes extends AbstractArrays implements ConstraintInterface
{
    /**
     * Valid Mimetypes array
     *
     * Override in the Request using $options['mimetype_array'] entry.
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $mimetype_array = array(
        'image/gif',
        'image/jpeg',
        'image/png',
        'application/pdf',
        'application/odt',
        'text/plain',
        'text/rtf');

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
        $options = $this->setPropertyKeyWithOptionKey('mimetype_array', $options);

        $this->getCompareToArrayFromInput('mimetype_array', $this->mimetype_array);

        parent::__construct(
            $constraint,
            $method,
            $field_name,
            $field_value,
            $options
        );
    }
}
