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
abstract class AbstractSomething extends AbstractConstraintTests implements ConstraintInterface
{
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
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        if ($this->validation() === true) {
            return true;
        }

        $this->setValidateMessage($this->message_code);

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
        if ($this->validation() === true) {
        } else {
            $this->field_value = null;
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
        if ($this->field_value === null) {
            return false;
        }

        if ($this->field_value === null
            || trim($this->field_value) === ''
            || $this->field_value === 0
        ) {
            return false;
        }

        return true;
    }
}
