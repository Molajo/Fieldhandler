<?php
/**
 * Contains Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Contains Constraint
 *
 * Within the string, a specified value exists.
 *
 * #### Validate
 *
 * Verifies value against constraint, returning a TRUE or FALSE result and error messages
 *
 * In this example, the response is `false` since the string does not contain the value specified.
 *
 * ```php
 * $options = array();
 * $options['contains'] = 'dog';
 * $response = $request->validate('field_name', 'The cat meows.', 'Contains', $options);
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
 * #### Sanitize
 *
 * Sets field to null if the value specified does not exist in the string.
 *
 * In this example, the $field_value is NULL.
 *
 * ```php
 * $options = array();
 * $options['contains'] = 'dog';
 * $response = $request->validate('field_name', 'The cat meows.', 'Contains', $options);
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * #### Format
 *
 * For this constraint, the `format` method is not implemented. The value sent in is not evaluated or changed.
 *
 * @api
 * @link       http://us1.php.net/manual/en/function.ctype-alpha.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Contains extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Test Contains Array
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if ($this->testContains() === false) {
            $this->setValidateMessage(1000);

            return false;
        }

        return true;
    }

    /**
     * Test Contains
     *
     * @return  integer
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function testContains()
    {
        return mb_strpos($this->field_value, $this->getOption('contains'), 0, mb_detect_encoding($this->field_value));
    }
}
