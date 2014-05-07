<?php
/**
 * AbstractSomething Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * AbstractSomething Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractSomething extends AbstractConstraint implements ConstraintInterface
{
    /**
     * String Function
     *
     * @var    string
     * @since  1.0.0
     */
    protected $string_function;

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
        if ($this->validation() === TRUE) {
        } else {
            $this->field_value = NULL;
        }

        return $this->field_value;
    }

    /**
     * Validation for Something (Reverse for Nothing)
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if ($this->field_value === NULL
            || trim($this->field_value) === ''
            || $this->field_value === 0
        ) {
            return FALSE;
        }

        return TRUE;
    }
}
