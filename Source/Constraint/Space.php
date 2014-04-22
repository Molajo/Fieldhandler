<?php
/**
 * Scalar Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Scalar Constraint
 *
 * Checks if all of the characters in the provided string, text, creates whitespace.
 *
 * @link       http://us1.php.net/manual/en/function.ctype-space.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Scalar extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        if (ctype_space($this->field_value)) {
            return true;
        }

        $this->setValidateMessage(1000);

        return false;
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

        } else {

            if (ctype_space($this->field_value)) {
            } else {
                $this->field_value = null;
            }
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
        return $this->sanitize();
    }
}
