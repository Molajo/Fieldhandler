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
class Email extends Abstractfiltervar implements ConstraintInterface
{
    /**
     * Filter Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $filter_type = FILTER_VALIDATE_EMAIL;

    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        parent::validate();

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
     * Format
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function format()
    {
        $this->sanitize();

        if (isset($this->options['obfuscate_email'])) {
            $obfuscate_email = "";

            for ($i = 0; $i < strlen($this->field_value); $i ++) {
                $obfuscate_email .= "&#" . ord($this->field_value[$i]) . ";";
            }

            $this->field_value = $obfuscate_email;
        }

        return $this->field_value;
    }

    /**
     * Verify MX Record for Host
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function checkMX($host)
    {
        if (isset($this->options['check_mx'])) {
            if (checkdnsrr($host, 'MX')) {
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Check Host DNS Records for at least one (MX, A, AAAA)
     *
     * @param   string $host
     *
     * @return bool
     */
    protected function checkHost($host)
    {
        if (isset($this->options['check_host'])) {
            if (checkdnsrr($host, 'MX') || checkdnsrr($host, "A") || checkdnsrr($host, "AAAA")) {
            } else {
                return false;
            }
        }

        return true;
    }
}
