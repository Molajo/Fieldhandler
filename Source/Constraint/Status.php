<?php
/**
 * Status Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Status Constraint
 *
 * Includes only digits, plus and minus sign.
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * This example returns true.
 *
 * ```php
 * $response = $request->validate('integer_field', 100, 'Status');
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
 * $response = $request->sanitize('integer_field', 'AmyStephen@gmail.com', 'Status');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Not implemented, simply returns the value sent in.
 *
 * @api
 * @link       http://us1.php.net/manual/en/filter.filters.sanitize.php
 * @link       http://us1.php.net/manual/en/filter.filters.validate.php
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Status extends AbstractFiltervar implements ConstraintInterface
{
    /**
     * Validate Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $validate_filter = FILTER_VALIDATE_INT;

    /**
     * Sanitize Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $sanitize_filter = FILTER_SANITIZE_NUMBER_INT;

    /**
     * Sanitize Array
     *
     * @var    array
     * @since  1.0.0
     */
    protected $status_array = array(2, 1, -1, -2, -5, -10, 0);

    /**
     * Sanitize
     *
     * @return  null|mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        parent::sanitize();

        if (in_array($this->field_value, $this->status_array)) {
            return (int)$this->field_value;
        }

        return 0;
    }
}
