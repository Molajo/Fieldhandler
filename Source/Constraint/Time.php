<?php
/**
 * Time Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Time Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Time extends AbstractConstraint implements ConstraintInterface
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
     * @return  boolean
     * @since   1.0.0
     */
    public function validation()
    {
        if ($this->field_value === NULL) {
            return TRUE;
        }

        if (strtotime($this->field_value)) {
            return TRUE;
        }

        return FALSE;
    }
}
