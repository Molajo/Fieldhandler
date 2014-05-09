<?php
/**
 * Float Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Float Constraint
 *
 * Remove all characters except digits, +- and optionally .,eE.
 *
 * Can be used with the following flags by defining $option entries for each flag desired:
 *
 * ```php
 * $options = array();
 * $options[FILTER_FLAG_ALLOW_FRACTION]   = true;
 * $options[FILTER_FLAG_ALLOW_THOUSAND]   = true;
 * $options[FILTER_FLAG_ALLOW_SCIENTIFIC] = true;
 *
 * ```
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * This example returns true.
 *
 * ```php
 * $options = array();
 * $options[FILTER_FLAG_ALLOW_FRACTION]   = true;
 * $response = $request->validate('float_field', 0.2345, 'Float');
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
 *  `$field_value` will result in NULL.
 *
 * ```php
 * $response = $request->sanitize('float_field', 'Dog', 'Float');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Performs sanitize.
 *
 * @api
 * @link       http://php.net/manual/en/function.is-float.php
 * @link       http://php.net/manual/en/function.is-double.php
 * @link       http://php.net/manual/en/function.is-real.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Float extends AbstractFiltervar implements ConstraintInterface
{
    /**
     * Validate Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $validate_filter = FILTER_VALIDATE_FLOAT;

    /**
     * Sanitize Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $sanitize_filter = FILTER_SANITIZE_NUMBER_FLOAT;

    /**
     * Constraint Flags
     *
     * To enable flags for use with the request, add the flags to the options array
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $constraint_allowable_options = array(
        FILTER_FLAG_ALLOW_FRACTION,
        FILTER_FLAG_ALLOW_THOUSAND,
        FILTER_FLAG_ALLOW_SCIENTIFIC
    );

    /**
     * Sanitize
     *
     * @return  null|mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        parent::sanitize();

        if (is_numeric($this->field_value)) {
            return (float) $this->field_value;
        }

        return $this->field_value;
    }
}
