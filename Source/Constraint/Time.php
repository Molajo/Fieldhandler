<?php
/**
 * Time Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;
use DateTime;

/**
 * Time Constraint
 *
 * Must be a valid formatted time.
 *
 * #### Valitime
 *
 * Verifies the time according to the format defined in $options['create_from_time_format'], returning
 *  true if valid or false and error messages if not valid.
 *
 * ```php
 * $options = array();
 * $options['create_from_time_format'] = 'H:i:s';
 * $response = $request->sanitize('time_field', '12:30:00', 'time', $options);
 *
 * if ($response->getValitimeResponse() === true) {
 *     // all is well
 * } else {
 *     foreach ($response->getValitimeMessages as $code => $message) {
 *         echo $code . ': ' . $message . '/n';
 *     }
 * }
 *
 * ```
 *
 * #### Sanitize
 *
 * Validate the time and returns null for $field_value if the time does not conform to the constraint.
 *
 * ```php
 * $options = array();
 * $options['create_from_time_format'] = 'Y-m-d';
 * $response = $request->sanitize('time_field', '2013-12-31', 'time', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * Formats a time according to the format defined in $options['display_as_time_format'];
 *
 * ```php
 * $options = array();
 * $options['create_from_time_format'] = 'Y-m-d';
 * $options['display_as_time_format'] = 'd/m/Y';
 * $response = $request->sanitize('time_field', '2013-12-31', 'time', $options);
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
class Time extends AbstractConstraintTests implements ConstraintInterface
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

        $time = $this->createFromFormat();

        if ($time === false) {
            $this->field_value = null;
        }

        $format = $this->getOption('display_as_time_format', 'H:i:s');

        $this->field_value = $time->format($format);

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
        $time = $this->createFromFormat();

        if ($time === false) {
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
        $format = $this->getOption('create_from_time_format', 'H:i:s');

        $time = DateTime::createFromFormat($format, $this->field_value);

        $errors = DateTime::getLastErrors();
        if ($errors['warning_count'] > 0) {
            return false;
        }

        return $time;
    }
}
