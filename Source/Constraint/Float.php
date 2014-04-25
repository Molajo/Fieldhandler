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
     * Filter Type
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $filter_type = FILTER_VALIDATE_FLOAT;

    /**
     * Validate
     *
     * Tests a value to determine if it is a valid Float value or should be processed by the
     *   sanitize method responding with true or false and messages
     *
     * @code
     *
     *  ```php
     *
     *  $request = new Molajo\Fieldhandler\Request();
     *  $results = $request->validate('Float field', $field_value, 'Float');
     *
     *  if ($results->getValidateResponse() === true) {
     *      // all is good
     *  } else {
     *      foreach ($results->getValidateMessages() as $error) {
     *          echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
     *      }
     *  }
     *
     *  ```
     *
     * @api
     * @link    http://www.php.net/manual/en/filter.filters.sanitize.php
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        return parent::validate();
    }

    /**
     * Sanitize
     *
     * Sanitizes the field value to ensure contains are float data type
     *
     * @code
     *
     * ```php
     *
     * $response = $request->sanitize($field_name, $field_value, 'Float', $options);
     *
     * // Replace the existing value if it was changed by filtering
     *
     * if ($response->getChangeIndicator() === true) {
     *     $field_value = $response->getFieldValue();
     * }
     *
     * ```
     *
     * @api
     * @link    http://www.php.net/manual/en/filter.filters.sanitize.php
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        return parent::sanitize();
    }

    /**
     * Format
     *
     * Not used with Float, simply returns the field value sent in
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function format()
    {
        return $this->field_value;
    }
}
