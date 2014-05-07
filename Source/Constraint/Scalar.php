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
 * Scalar variables are those containing an integer, float, string or boolean.
 * Types array, object and resource are not scalar.
 *
 * @link       http://php.net/manual/en/function.is-scalar.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Scalar extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

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
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === NULL) {

        } else {

            if (is_scalar($this->field_value)) {
            } else {
                $this->field_value = NULL;
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
        return parent::format();
    }

    /**
     * Validation
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if (is_scalar($this->field_value)) {
            return TRUE;
        }

        return FALSE;
    }
}
