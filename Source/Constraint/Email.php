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
class Email extends AbstractFiltervar implements ConstraintInterface
{
    /**
     * Filter Type
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $filter_type = FILTER_VALIDATE_EMAIL;

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
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function format()
    {
        $this->sanitize();

        if ($this->getOption('obfuscate_email') === null) {
            return $this->field_value;
        }

        $obfuscate_email = "";

        for ($i = 0; $i < strlen($this->field_value); $i ++) {
            $obfuscate_email .= "&#" . ord($this->field_value[ $i ]) . ";";
        }

        $this->field_value = $obfuscate_email;

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
        $valid = true;

        $host = $this->getHost();

        if ($this->checkMX($host) === true) {
        } else {
            $valid = false;
        }

        if ($this->checkHost($host) === true) {
        } else {
            $valid = false;
        }

        return $valid;
    }

    /**
     * Extract Host
     *
     * @return  null|string
     * @since   1.0.0
     */
    protected function getHost()
    {
        $email_parts = explode('@', $this->field_value);

        if (is_array($email_parts) && count($email_parts) === 2) {
            return $email_parts[1];
        }

        return null;
    }

    /**
     * Verify MX Record for Host
     *
     * @param   string $host
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function checkMX($host = null)
    {
        if ($this->getOption('check_mx') === null) {
            return true;
        }

        if (checkdnsrr($host, 'MX')) {
        } else {
            return false;
        }

        return true;
    }

    /**
     * Check Host DNS Records for at least one (MX, A, AAAA)
     *
     * @param   string $host
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function checkHost($host = null)
    {
        if ($this->getOption('check_host') === null) {
            return true;
        }

        $response = (int)checkdnsrr($host, 'MX');
        $response = $response + (int)checkdnsrr($host, 'A');
        $response = $response + (int)checkdnsrr($host, 'AAAA');

        if ($response > 0) {
            return true;
        }

        return false;
    }
}
