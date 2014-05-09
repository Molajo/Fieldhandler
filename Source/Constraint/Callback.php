<?php
/**
 * Callback Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Callable Constraint
 *
 * Enables use of a callable function or method to sanitize, filter or format data
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * In this example, the data value 'hello' is input to the callback 'strtoupper' and the result 'HELLO'
 * is compared to the original value. Since the values are different, `false` is returned.
 *
 * ```php
 * $options             = array();
 * $options['callback'] = 'strtoupper';
 * $response = $request->validate('callback_field', 'hello', 'Callback', $options);
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
 * Executes the callable against the data value to produce a sanitized result.
 *
 * In this example, `$field_value` will result in `HELLO`.
 *
 * ```php
 * $options             = array();
 * $options['callback'] = 'strtoupper';
 * $response = $request->sanitize('callback_field', 'hello', 'Callback', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * For `callback`, the `format` method produces the same results as `sanitize`. It can be
 * used to format data, as needed.
 *
 * @api
 * @link       http://us1.php.net/manual/en/filter.filters.misc.php
 * @link       http://us3.php.net/callback
 * @link       http://us3.php.net/manual/en/language.types.callable.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Callback extends AbstractFiltervar implements ConstraintInterface
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
    protected $sanitize_filter = FILTER_CALLBACK;

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Validation
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        $hold = $this->field_value;

        if ($hold === $this->sanitize()) {
            return true;
        }

        $this->setValidateMessage($this->message_code);

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
        $this->field_value = filter_var($this->field_value, $this->sanitize_filter, $this->setCallback());

        return $this->field_value;
    }

    /**
     * Format
     *
     * @return  null|mixed
     * @since   1.0.0
     */
    public function format()
    {
        return $this->sanitize();
    }

    /**
     * Callback set in the $options array for $request
     *
     * @return  array
     * @since   1.0.0
     */
    protected function setCallback()
    {
        $return            = array();
        $return['options'] = $this->getOption('callback', null);

        return $return;
    }
}
