<?php
/**
 * Required Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Required Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Required extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 13000;

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
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function sanitize()
    {
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
     * Validation test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if ($this->field_value === NULL) {
            return FALSE;
        }

        return TRUE;
    }
}
