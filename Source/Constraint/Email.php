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
 * Only letters, digits and !#$%&'*+-/=?^_`{|}~@.[].
 *
 * **Validate**
 *
 * Verifies value against constraint and provides messages with false test.
 *
 * This example returns true.
 *
 * ```php
 * $response = $request->validate('email_field', 'AmyStephen@gmail.com', 'Email');
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
 * **Sanitize**
 *
 * Removes characters not conforming to the definition of the constraint. In this example,
 *  `$field_value` will result in NULL.
 *
 * ```php
 * $response = $request->sanitize('email_field', 'AmyStephen@gmail.com', 'Email');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * **Format**
 *
 * Set the `obfuscate_email` option to format the email in that manner.
 *
 * ```php
 * $options = array();
 * $options['obfuscate_email'] = true;
 * $response = $request->sanitize('email_field', 'AmyStephen@gmail.com', 'Email', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * @api
 * @link       http://us1.php.net/manual/en/filter.filters.sanitize.php
 * @link       http://us1.php.net/manual/en/filter.filters.validate.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Email extends AbstractFiltervar implements ConstraintInterface
{
    /**
     * Validate Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $validate_filter = FILTER_VALIDATE_EMAIL;

    /**
     * Sanitize Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $sanitize_filter = FILTER_SANITIZE_EMAIL;

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

        for ($i = 0; $i < strlen($this->field_value); $i++) {
            $obfuscate_email .= "&#" . ord($this->field_value[ $i ]) . ";";
        }

        $this->field_value = $obfuscate_email;

        return $this->field_value;
    }
}
