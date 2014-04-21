<?php
/**
 * Email Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Email Constraint
 *
 * @link       http://php.net/manual/en/function.checkdnsrr.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Email extends AbstractConstraint implements ConstraintInterface
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

        if (filter_var($this->field_value, FILTER_VALIDATE_EMAIL) === false) {
            $this->setValidateMessage(2000);
            return false;
        }

        $host        = '';
        $email_parts = explode('@', $this->field_value);
        if (is_array($email_parts) && count($email_parts) === 2) {
            $host = $email_parts[1];
        } else {
            $this->setValidateMessage(2000);
            return false;
        }

        if (checkdnsrr($host, 'MX')) {
        } else {
            $this->setValidateMessage(2000);
            return false;
        }

        return true;
    }

    /**
     * Handle Input
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function handleInput()
    {
        if ($this->validate()) {
        } else {
            $this->field_value = null;
        }

        return $this->field_value;
    }

    /**
     * Handle Output
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function handleOutput()
    {
        return $this->handleInput();
    }
}
