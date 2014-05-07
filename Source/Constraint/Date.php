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
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 2000;

    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        return parent::validate();
    }

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === NULL) {
            return TRUE;
        }

        $date = $this->createFromFormat();

        if ($date === FALSE) {
            $this->field_value = NULL;
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
        if ($this->field_value === NULL) {
            return TRUE;
        }

        $date = $this->createFromFormat();

        if ($date === FALSE) {
            $this->field_value = NULL;
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

        if ($date === FALSE) {
            $this->setValidateMessage(2000);

            return FALSE;
        }

        return FALSE;
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
            return FALSE;
        }

        return $date;
    }
}
