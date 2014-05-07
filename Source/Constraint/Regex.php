<?php
/**
 * Regex Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\ConstraintInterface;

/**
 * Regex Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Regex extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Method Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $method_test = 'getRegex';

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 8000;

    /**
     * Validation
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if ($this->getRegex() === TRUE) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Format
     *
     * @return  integer
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getRegex()
    {
        return preg_match($this->getOption('regex'), $this->field_value);
    }
}
