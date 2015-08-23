<?php
/**
 * Defaults Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Defaults Constraint
 *
 * Applies default value for sanitize and verifies if the value requires a default for validate.
 *
 * #### Validate
 *
 * Verifies if the value is null, if so, returns a FALSE that a default has not been applied.
 * If the field has a value, validate returns TRUE.
 *
 * ```php
 * $response = $request->validate('any_field', null, 'Defaults');
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
 * Applies the default value defined in the `$options` array to the value, if the value is NULL.
 *
 * ```php
 * $options = array();
 * $options['default_value'] = $default;
 * $response = $request->validate('any_field', NULL, 'Defaults');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Not implemented. Value sent in is not evaluated or changed.
 *
 * @api
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Defaults extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 7000;

    /**
     * Validate
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value !== null) {
            return true;
        }

        $this->setValidateMessage($this->message_code);

        return false;
    }

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === null) {
            $this->field_value = $this->getOption('default');
        }

        return $this->field_value;
    }
}
