<?php
/**
 * AbstractDatetime Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;
use Datetime;

/**
 * AbstractDatetime Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractDatetime extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 2000;

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $default_format = 'Y-m-d';

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

        $format = $this->getOption('display_as_format', $this->default_format);

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
        $result = $this->createFromFormat();

        if ($result === false) {
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
        $format = $this->getOption('create_from_format', $this->default_format);

        $formatted_value = DateTime::createFromFormat($format, $this->field_value);

        $errors = DateTime::getLastErrors();
        if ($errors['warning_count'] > 0) {
            return false;
        }

        return $formatted_value;
    }
}
