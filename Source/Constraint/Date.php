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
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Date extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        $date = $this->createFromFormat();

        if ($date === false) {
            $this->setValidateMessage(2000);
            return false;
        }

        return true;
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
            return true;
        }

        $date = $this->createFromFormat();

        if ($date === false) {
            $this->field_value = null;
        }

        return $this->field_value;
    }

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

        if (isset($this->options['display_as_date_format'])) {
            $format = $this->options['display_as_date_format'];
        } else {
            $format = 'Y-m-d';
        }

        $this->field_value = $date->format($format);

        return $this->field_value;
    }

    /**
     * Create Data from a specific format
     *
     * @return  mixed
     * @since   1.0.0
     */
    protected function createFromFormat()
    {
        if (isset($this->options['create_from_date_format'])) {
            $format = $this->options['create_from_date_format'];
        } else {
            $format = 'Y-m-d';
        }

        $date = DateTime::createFromFormat($format, $this->field_value);

        $errors = DateTime::getLastErrors();
        if ($errors['warning_count'] > 0) {
            return false;
        }

        return $date;
    }
}
