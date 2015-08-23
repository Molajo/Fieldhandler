<?php
/**
 * Filename Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Filename Constraint
 *
 * Must be a valid filename.
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * ```php
 * $response = $request->validate('filename_field', 'This will not validate', 'Filename');
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
 * Converts the value to null if not valid.
 *
 * ```php
 * $response = $request->sanitize('filename_field', 'This will not validate', 'Filename');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * For `filename`, the `format` method produces the same results as `sanitize`.
 *
 * @api
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Filename extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Format
     *
     * @return  string
     * @since   1.0.0
     */
    public function format()
    {
        return $this->sanitize();
    }

    /**
     * Validation test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if ($this->field_value === null || trim($this->field_value) === '') {
            return true;
        }

        $filename = $this->field_value;
        if (is_file($filename)) {
            return true;
        }

        return false;
    }

    /**
     * Sanitize Filename
     *
     * @return  string
     * @since   1.0.0
     */
    protected function sanitise()
    {
        if ($this->validation() === true) {
            return $this->field_value;
        }

        return null;
    }
}
