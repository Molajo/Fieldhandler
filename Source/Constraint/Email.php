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
     * Validate
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        return parent::validate();
    }

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

        if ($this->getOption('obfuscate_email') === NULL) {
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
        $email_parts = explode('@', $this->field_value);

        if (is_array($email_parts) && count($email_parts) === 2) {
            $host = $email_parts[1];
        } else {
            return FALSE;
        }

        if ($this->checkMX($host)) {
        } else {
            return FALSE;
        }

        if ($this->checkHost($host)) {
        } else {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Verify MX Record for Host
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function checkMX($host)
    {
        if ($this->getOption('check_mx') === NULL) {
        } else {
            if (checkdnsrr($host, 'MX')) {
            } else {
                return FALSE;
            }
        }

        return TRUE;
    }

    /**
     * Check Host DNS Records for at least one (MX, A, AAAA)
     *
     * @param   string $host
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function checkHost($host)
    {
        if ($this->getOption('check_host') === NULL) {
        } else {
            if (checkdnsrr($host, 'MX') || checkdnsrr($host, "A") || checkdnsrr($host, "AAAA")) {
            } else {
                return FALSE;
            }
        }

        return TRUE;
    }
}
