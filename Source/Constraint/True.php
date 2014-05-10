<?php
/**
 * True Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * True Constraint
 *
 * Value must conform to one of the values defined within the $true_array.
 *
 * To override, send in an options entry of the values desired:
 *
 * ```php
 *
 * $true_array = array(true, 1, 'yes', 'on');
 * $options = array();
 * $options{'true_array'] = $true_array;
 *
 * ```
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * ```php
 * $response = $request->validate('true_only_field', $value, 'True');
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
 * Returns null if value is not defined within the $true_array.
 *
 * ```php
 * $response = $request->validate('true_only_field', $value, 'True');
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
 * @api
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class True extends AbstractArrays implements ConstraintInterface
{
    /**
     * True array
     *
     * Override in the Request using $options['true_array'] entry.
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $true_array = array(true, 1, 'yes', 'on');

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
        $options = $this->setPropertyKeyWithOptionKey('true_array', $options);

        $this->getCompareToArrayFromInput('true_array', $this->true_array);

        parent::__construct(
            $constraint,
            $method,
            $field_name,
            $field_value,
            $options
        );
    }
}
