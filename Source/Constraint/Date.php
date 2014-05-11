<?php
/**
 * Date Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;
use DateTime;

/**
 * Date Constraint
 *
 * Must be a valid formatted date.
 *
 * #### Validate
 *
 * Verifies the date according to the format defined in $options['create_from_date_format'], returning
 *  true if valid or false and error messages if not valid.
 *
 * ```php
 * $options = array();
 * $options['create_from_date_format'] = 'Y-m-d';
 * $response = $request->sanitize('date_field', '2013-12-31', 'Date', $options);
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
 * Validates the date and returns null for $field_value if the date does not conform to the constraint.
 *
 * ```php
 * $options = array();
 * $options['create_from_date_format'] = 'Y-m-d';
 * $response = $request->sanitize('date_field', '2013-12-31', 'Date', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Formats a date according to the format defined in $options['display_as_date_format'];
 *
 * ```php
 * $options = array();
 * $options['create_from_date_format'] = 'Y-m-d';
 * $options['display_as_date_format'] = 'd/m/Y';
 * $response = $request->sanitize('date_field', '2013-12-31', 'Date', $options);
 *
 * echo $response->getFieldValue();
 *
 * ```
 *
 * @api
 * @link       http://us1.php.net/manual/en/function.ctype-cntrl.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Date extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 2000;

    /**
     * Format
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function format()
    {
        if ($this->field_value === null) {
            return true;
        }

        $date = $this->createFromFormat();

        if ($date === false) {
            $this->field_value = null;
        }

        $format = $this->getOption('display_as_date_format', 'Y-m-d');

        $this->field_value = $date->format($format);

        return $this->field_value;
    }

    /**
     * Validation Test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        $date = $this->createFromFormat();

        if ($date === false) {
            return false;
        }

        return true;
    }

    /**
     * Create Data from a specific format
     *
     * @return  mixed
     * @since   1.0.0
     */
    protected function createFromFormat()
    {
        $format = $this->getOption('create_from_date_format', 'Y-m-d');

        $date = DateTime::createFromFormat($format, $this->field_value);

        $errors = DateTime::getLastErrors();
        if ($errors['warning_count'] > 0) {
            return false;
        }

        return $date;
    }
}
