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
class Required extends AbstractNull implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 13000;

    /**
     * Validation
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if (parent::validation() === TRUE) {
            return FALSE;
        }

        return TRUE;
    }
}
