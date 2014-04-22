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

        $email_parts = explode('@', $this->field_value);

        if (is_array($email_parts) && count($email_parts) === 2) {
            $host = $email_parts[1];
        } else {
            $this->setValidateMessage(2000);
            return false;
        }

        if ($this->checkMX($host)) {
        } else {
            $this->setValidateMessage(2000);
            return false;
        }

        if ($this->checkHost($host)) {
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
        $this->field_value = filter_var($this->field_value, FILTER_VALIDATE_EMAIL);

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
        $this->handleInput();

        if ($this->options['obfuscate_email'] === true) {
            $obfuscate_email = "";

            for ($i = 0; $i < strlen($this->field_value); $i ++) {
                $obfuscate_email .= "&#" . ord($this->field_value[$i]) . ";";
            }

            $this->field_value = $obfuscate_email;
        }

        return $this->field_value;
    }
}
