<?php
/**
 * Something Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Something Constraint
 *
 * Value must not be one of the values defined within the $valid_values_array.
 *
 * To override, send in an options entry of the values desired:
 *
 * ```php
 *
 * $valid_values_array = array(false, 0, ' ', NULL);
 * $options = array();
 * $options['valid_values_array'] = $valid_values_array;
 *
 * ```
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * ```php
 * $response = $request->validate('random_field', $value, 'Something');
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
 * Returns null if value is defined within the $valid_values_array.
 *
 * ```php
 * $response = $request->validate('random_field', $value, 'Something');
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
class Something extends AbstractArrays implements ConstraintInterface
{
    /**
     * Ignore Null
     *
     * @api
     * @var    boolean
     * @since  1.0.0
     */
    protected $ignore_null = false;

    /**
     * Copy of Nothing array
     *
     * Override in the Request using $options['valid_values_array'] entry.
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $valid_values_array = array(false, 0, ' ', NULL);

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Validate - testing for "nothing" - reverse results for "something"
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        $results = parent::validate();

        if ($results == false) {
            $this->validate_messages = array();
            return true;
        }

        $this->setValidateMessage($this->message_code);

        return false;
    }

    /**
     * Sanitize - testing for "nothing" - reverse results for "something"
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function sanitize()
    {
        $hold = $this->field_value;

        parent::sanitize();

        if ($this->field_value === null) {
            $this->field_value = $hold;
        } else {
            $this->field_value = null;
        }

        return $this->field_value;
    }
}
