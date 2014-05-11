<?php
/**
 * Greaterthan Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Greaterthan Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Greaterthan extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Verify that the values are not equal
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function validation()
    {
        if ($this->field_value > $this->getOption('greater_than')) {
            return true;
        }

        return false;
    }
}
