<?php
/**
 * Trim Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Trim Constraint
 *
 * The text must not have spaces before or after the last visible character.
 *
 * **Validate**
 *
 * Verifies value against constraint and provides messages with false test.
 *
 * This example returns false due to the inclusion of spaces before and after the text string.
 *
 * ```php
 * $response = $request->validate('upper_field', ' This is not trimmed. ', 'Upper');
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
 *  `$field_value` will result in 'This is trimmed.' and the spaces preceding and following
 *  the text literal will be removed.
 *
 * ```php
 * $options = array();
 * $options['allow_space_character'] = true;
 * $response = $request->sanitize('upper_field', ' This is trimmed. ', 'Upper');
 *
 * if ($response->getChangeIndicator() === true) {
 *     $field_value = $response->getFieldValue();
 * }
 *
 * ```
 *
 * **Format**
 *
 * Performs sanitize.
 *
 * @api
 * @link       http://us1.php.net/manual/en/function.ctype-upper.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Trim extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === $this->sanitize()) {
            return true;
        }

        $this->setValidateMessage(2000);

        return false;
    }

    /**
     * Sanitize
     *
     * @return  string
     * @since   1.0.0
     */
    public function sanitize()
    {
        return trim($this->field_value);
    }

    /**
     * Format
     *
     * @return  string
     * @since   1.0.0
     */
    public function format()
    {
        return $this->sanitize();
    }
}
