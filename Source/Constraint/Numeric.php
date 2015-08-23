<?php
/**
 * Numeric Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Numeric Constraint
 *
 * Characters must be numeric.
 *
 * #### Validate
 *
 * Verifies if the value is numeric.
 *
 * ```php
 * $response = $request->validate('any_field', 234, 'Numeric');
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
 * Returns null if value is not numeric.
 *
 * ```php
 * $response = $request->validate('any_field', 'dog', 'Numeric');
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
 */
class Numeric extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Validation test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if (is_numeric($this->field_value)) {
            return true;
        }

        return false;
    }

    /**
     * Sanitize
     *
     * @return  null|mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->validation() === true) {
            return $this->field_value;
        }

        return null;
    }
}
